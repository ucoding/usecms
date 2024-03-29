<?php
//公共类
class commonMod
{
    protected $model = NULL; //数据库模型
    protected $layout = NULL; //布局视图
    protected $config = array();
    private $_data = array();

    protected function init()
    {
    }

    public function __construct()
    {
        global $config;
        session_start();
        $this->config = $config;
        $this->model = self::initModel($this->config);
        $this->init();
        $this->check_login();
    }


    //初始化模型
    static public function initModel($config)
    {
        static $model = NULL;
        if (empty($model)) {
            $model = new cpModel($config);
        }
        return $model;
    }

    public function __get($name)
    {
        return isset($this->_data[$name]) ? $this->_data[$name] : NULL;
    }

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }


    //获取模板对象
    public function view()
    {
        static $view = NULL;
        if (empty($view)) {
            $view = new cpTemplate($this->config);
        }
        return $view;
    }

    //模板赋值
    protected function assign($name, $value)
    {
        return $this->view()->assign($name, $value);
    }

    //模板显示
    protected function display($tpl = '', $return = false, $is_tpl = true, $diy_tpl = false)
    {
        if ($is_tpl) {
            $tpl = empty($tpl) ? $_GET['_module'] . '/' . $_GET['_action'] : $tpl;
            if ($is_tpl && $this->layout) {
                $this->__template_file = $tpl;
                $tpl = $this->layout;
            }
        }

        $this->assign("model", $this->model);
        $this->assign('sys', $this->config);
        $this->assign('config', $this->config);
        $this->assign('js', $this->load_js());
        $this->assign('css', $this->load_css());
        $this->assign('user', model('user')->current_user());

        $this->view()->assign($this->_data);
        return $this->view()->display($tpl, $return, $is_tpl, $diy_tpl);
    }

    //包含内模板显示
    protected function show($tpl = '')
    {
        $content = $this->display($tpl, true);
        $body = $this->display('index/common', true);
        $html = str_replace('<@body>', $content, $body);
        echo $html;
    }

    //判断是否是数据提交
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    //登录检测
    protected function check_login()
    {

        if ($_GET['_module'] == 'login' || substr($_GET['_action'], -6) == 'ignore') {
            return true;
        }
        if (!empty($_GET['key'])) {
            $key = urldecode($_GET['key']);
            $syskey = $this->config['SPOT'] . $this->config['DB_NAME'];
            if ($key == $syskey) {
                return true;
            }
        }
        $code = $_SESSION[$this->config['SPOT'] . '_user'];
        $uid = cp_decode($code, $this->config['DB_PREFIX']);
        //读取登录信息
        if (empty($uid)) {
            $this->redirect(__APP__ . '/login');
        }
        $user = model('login')->user_info_id($uid);
        if (empty($user)) {
            $this->redirect(__APP__ . '/login');
        }
        $this->check_pw($user);
        return true;
    }

    //检测模块权限
    protected function check_pw($user)
    {
        if ($user['keep'] == 1) {
            return true;
        }

        if (empty($user['model_power'])) {
            return true;
        }
        $module = in($_GET['_module']);
        //处理栏目权限
        if (substr($module, -8) == 'category') {
            $module = 'category';
        }
        $info = model('menu')->module_menu($module);
        if (!in_array($info['id'], $user['model_power'])) {
            $this->msg('您没有权限进行操作！');
        }
    }

    //直接跳转
    protected function redirect($url)
    {
        header('location:' . $url, false, 301);
        exit;
    }

    //弹出信息
    protected function alert($msg, $url = NULL)
    {
        header("Content-type: text/html; charset=utf-8");
        $alert_msg = "alert('$msg');";
        if (empty($url)) {
            $gourl = 'history.go(-1);';
        } else {
            $gourl = "window.location.href = '{$url}'";
        }
        echo "<script>$alert_msg $gourl</script>";
        exit;
    }

    //提示
    public function msg($message, $status = 1)
    {
        @header("Content-type:text/plain");
        echo json_encode(array('status' => $status, 'message' => $message));
        exit;
    }

    //JSUI库
    public function load_js()
    {
        $js = '';
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/js/jquery.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/js/duxui.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/js/dialog/lhgdialog.min.js?skin=default"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/kindeditor/kindeditor-min.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/kindeditor/lang/zh_CN.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/js/common.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/ztree/jquery.ztree.js"></script>' . PHP_EOL;
        $js .= '<script type=text/javascript src="' . __ADMINRES__ . '/ztree/jquery.ztree.exhide.js"></script>' . PHP_EOL;
        return $js;
    }

    //CSSUI库
    public function load_css()
    {
        $css = '';
        $css .= '<link href="' . __ADMINRES__ . '/css/base.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
        $css .= '<link href="' . __ADMINRES__ . '/css/style.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
        $css .= '<link href="' . __ADMINRES__ . '/kindeditor/themes/default/default.css" rel="stylesheet" type="text/css" />' . PHP_EOL;
        $css .= '<link href="' . __ADMINRES__ . '/ztree/css/zTreeStyle.css" rel="stylesheet" type="text/css"/>' . PHP_EOL;
        return $css;
    }

    //分页 $url:基准网址，$totalRows: $listRows列表每页显示行数$rollPage 分页栏每页显示的页数
    protected function page($url, $totalRows, $listRows = 20, $rollPage = 5)
    {
        $page = new Page();
        return $page->show($url, $totalRows, $listRows, $rollPage);
    }
}