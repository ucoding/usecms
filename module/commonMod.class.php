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

        $config['PLUGIN_PATH'] = __ROOTDIR__ . '/plugins/';
        $this->config = $config;
        $this->model = self::initModel($this->config);
        $this->init();
        Plugin::init();
    }

    public function _empty()
    {
        $this->error404();
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
    protected function display($tpl = '', $return = false, $is_tpl = true, $is_dir = true)
    {
        if ($this->config['LANG_OPEN']) {
            $lang = __LANG__ . '/';
        }
        if ($is_tpl) {
            $tpl = __ROOTDIR__ . '/' . $this->config['TPL_TEMPLATE_PATH'] . $lang . $tpl;
            if ($is_tpl && $this->layout) {
                $this->__template_file = $tpl;
                $tpl = $this->layout;
            }
        }

        $this->assign('model', $this->model);
        $this->assign('sys', $this->config);
        $this->assign('config', $this->config);
        $this->view()->assign($this->_data);
        return $this->view()->display($tpl, $return, $is_tpl, $is_dir);
    }

    //页面不存在
    protected function error404()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        $this->common = model('pageinfo')->media('您要查找的页面不存在');
        $this->display('404.html');
        exit;
    }

    //包含内模板显示
    protected function show($tpl = '')
    {
        $content = $this->display($tpl, true);
        $body = $this->display($this->config['TPL_COMMON'], true);
        $html = str_replace('<!--body-->', $content, $body);
        echo $html;
    }

    //脚本运行时间
    public function runtime()
    {
        $GLOBALS['_endTime'] = microtime(true);
        $runTime = number_format($GLOBALS['_endTime'] - $GLOBALS['_startTime'], 4);
        echo $runTime;
    }


    //判断是否是数据提交 
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    //直接跳转
    protected function redirect($url)
    {
        header('location:' . $url, false, 301);
        exit;
    }

    //操作成功之后跳转,默认三秒钟跳转
    protected function success($msg, $url = null, $waitSecond = 3)
    {
        if ($url == null)
            $url = __URL__;
        $this->assign('message', $this->getlang($msg));
        $this->assign('url', $url);
        $this->assign('waitSecond', $waitSecond);
        $this->display('success');
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

    //分页 
    protected function page($url, $totalRows, $listRows = 20, $rollPage = 5, $type = 0)
    {
        $page = new Page();
        if ($type == 0) {
            return $page->show($url, $totalRows, $listRows, $rollPage);
        } else if ($type == 1) {
            $page->show($url, $totalRows, $listRows, $rollPage);
            return $page->prePage('', 0);
        } else if ($type == 2) {
            $page->show($url, $totalRows, $listRows, $rollPage);
            return $page->nextPage('', 0);
        }
    }

    //插件钩子
    public function plus_hook($module, $action, $data = NULL)
    {
        $action_name = 'hook_' . $module . '_' . $action;
        $list = $this->model->table('plugin')->select();
        $plugin_list = Plugin::get();
        if (!empty($list)) {
            foreach ($list as $value) {
                if ($value['status'] == 1) {
                    foreach ($plugin_list as $plugin_name => $action_array) {
                        if (in_array($action_name, $action_array)) {
                            Plugin::run($plugin_name, $action_name, $data);
                        }
                    }
                }
            }
        }
    }

}

?>