<?php
class expand_modelMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }


    //模型列表
    public function index()
    {
        $this->list = model('expand_model')->model_list();
        $this->show();
    }

    //模型添加
    public function add()
    {
        $this->list = model('expand_model')->model_list();
        $this->display();
    }

    public function add_save()
    {
        //录入模型处理
        if (model('expand_model')->table_info($_POST['table'])) {
            $this->msg('表名不能重复！', 0);
        }
        if (model('expand_model')->add($_POST)) {
            $this->msg('模型添加成功！', 1);
        } else {
            $this->msg('模型添加失败', 0);
        }
    }

    //模型修改
    public function edit()
    {
        $mid = $_GET['mid'];
        if (empty($mid)) {
            $this->msg('未获取到模型ID！', 0);
        }
        $this->info = model('expand_model')->info($mid);
        $this->display();
    }

    public function edit_save()
    {
        //录入模型处理
        if (model('expand_model')->table_info($_POST['table'], $_POST['mid'])) {
            $this->msg('表名不能重复！', 0);
        }
        if (model('expand_model')->edit($_POST)) {
            $this->msg('模型修改成功！', 1);
        } else {
            $this->msg('模型修改失败', 0);
        }
    }

    //模型导入
    public function in()
    {
        $this->display();
    }

    public function in_data()
    {
        $table = $_POST['table'];
        if (empty($table)) {
            $this->msg('文件夹名尚未填写！', 0);
        }
        $dir = __ROOTDIR__ . '/data/ext_module/' . $table;
        $config = @Xml::decode(file_get_contents($dir . '/ext_model.xml'));
        $config = $config['config'];
        if (empty($config)) {
            $this->msg('无法获取模型配置！', 0);
        }
        if (!file_exists($dir) || !file_exists($dir . '/dbbak/')) {
            $this->msg($table . '目录不存在！或者目录结构错误！', 0);
        }
        if (model('expand_model')->table_info($config['model'])) {
            $this->msg($table . '模型已经存在，无法重复导入！', 0);
        }
        //导入数据库
        $db = new Dbbak($this->config['DB_HOST'], $this->config['DB_USER'], $this->config['DB_PWD'], $this->config['DB_NAME'], 'utf8', $dir . '/dbbak/');
        if (!$db->importSql('', $config['prefix'], $this->config['DB_PREFIX'])) {
            $this->msg('数据库导入失败！', 0);
        }
        //修改关联信息
        $info = model('expand_model')->associate_edit();
        $this->msg('模型导入完毕！', 1);

    }

    //模型导出
    public function out()
    {
        $mid = intval($_POST['mid']);
        $info = model('expand_model')->info($mid);

        //创建文件夹
        $dir = __ROOTDIR__ . '/data/ext_module/' . $info['table'];
        @mkdir($dir, 0777, true);
        if (!file_exists($dir)) {
            $this->msg('文件夹创建失败，请保证"/data/ext_module/"有写入权限', 0);
        }
        @mkdir($dir . '/dbbak/', 0777, true);
        if (!file_exists($dir . '/dbbak/')) {
            $this->msg('文件夹创建失败，请保证"/data/ext_module/dbbak/"有写入权限', 0);
        }
        $data_array = model('expand_model')->field_list_data($mid);
        if (empty($data_array)) {
            $this->msg('无法获取扩展模型字段', 0);
        }
        //导出数据库
        $db = new Dbbak($this->config['DB_HOST'], $this->config['DB_USER'], $this->config['DB_PWD'], $this->config['DB_NAME'], 'utf8', $dir . '/dbbak/');

        $sql = "INSERT INTO " . $this->config['DB_PREFIX'] . "expand_model VALUES('', '" . mysql_escape_string($info['table']) . "', '" . mysql_escape_string($info['name']) . "')\n";
        foreach ($data_array as $vo) {
            $sql .= "INSERT INTO " . $this->config['DB_PREFIX'] . "expand_model_field VALUES('', 101010, '" . mysql_escape_string($vo['name']) . "', '" . mysql_escape_string($vo['field']) . "', '" . mysql_escape_string($vo['type']) . "', '" . mysql_escape_string($vo['property']) . "', '" . mysql_escape_string($vo['len']) . "', '" . mysql_escape_string($vo['decimal']) . "', '" . mysql_escape_string($vo['default']) . "', '" . mysql_escape_string($vo['sequence']) . "', '" . mysql_escape_string($vo['tip']) . "', '" . mysql_escape_string($vo['must']) . "', '" . mysql_escape_string($vo['config']) . "')\n";
        }
        if (!$db->exportSql($this->config['DB_PREFIX'] . 'expand_content_' . $info['table'], 0, $sql)) {
            $this->msg('数据库导出失败！', 0);
        }

        //写入模型信息
        $html = '<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
        $html .= '<config>' . PHP_EOL;
        $html .= '<name>' . $info['name'] . '</name>' . PHP_EOL;
        $html .= '<table>' . $info['table'] . '</table>' . PHP_EOL;
        $html .= '<prefix>' . $this->config['DB_PREFIX'] . '</prefix>' . PHP_EOL;
        $html .= '</config>' . PHP_EOL;
        @file_put_contents($dir . '/ext_model.xml', $html);
        if (!file_exists($dir . '/ext_model.xml')) {
            $this->msg('扩展模型信息导出失败，请检查目录权限！', 0);
        }

        $this->msg('扩展模型导出完毕，请自行到"data/ext_module"中下载文件', 1);

    }

    //删除
    public function del()
    {
        $mid = intval($_POST['mid']);
        if (empty($mid)) {
            $this->msg('参数传递错误！', 0);
        }
        //删除模型
        if (model('expand_model')->del($_POST)) {
            $this->msg('模型删除成功！', 1);
        } else {
            $this->msg('模型删除失败', 0);
        }

    }

    //字段列表
    public function field_list()
    {
        $mid = intval($_GET['mid']);
        if (empty($mid)) {
            $this->msg('参数传递错误！', 0);
        }
        $this->info = model('expand_model')->info($mid);
        $this->list = model('expand_model')->field_list($mid);
        $this->show();
    }

    //字段添加
    public function field_add()
    {
        $mid = intval($_GET['mid']);
        if (empty($mid)) {
            $this->msg('参数传递错误！', 0);
        }
        $this->model_info = model('expand_model')->info($mid);
        $this->field_type = model('expand_model')->field_type();
        $this->field_property = model('expand_model')->field_property();
        $this->display();
    }

    public function field_add_save()
    {
        //录入模型处理
        if (model('expand_model')->field_info($_POST['field'], $_POST['mid'])) {
            $this->msg('字段不能重复！', 0);
        }
        if (model('expand_model')->field_add($_POST)) {
            $this->msg('字段添加成功！', 1);
        } else {
            $this->msg('字段添加失败', 0);
        }
    }

    //字段修改
    public function field_edit()
    {
        $fid = intval($_GET['fid']);
        if (empty($fid)) {
            $this->msg('参数传递错误！', 0);
        }
        $this->info = model('expand_model')->field_info_id($fid);
        $this->field_type = model('expand_model')->field_type();
        $this->field_property = model('expand_model')->field_property();
        $this->display();
    }

    public function field_edit_save()
    {
        if (empty($_POST['fid'])) {
            $this->msg('参数传递错误！', 0);
        }
        if (model('expand_model')->field_info($_POST['field'], $_POST['mid'], $_POST['fid'])) {
            $this->msg('字段不能重复！', 0);
        }
        //录入模型处理
        $id = model('expand_model')->field_edit($_POST);
        if (!empty($id)) {
            $this->msg('字段修改成功！', 1);
        } else {
            $this->msg('字段修改失败', 0);
        }
    }

    //字段删除
    public function field_del()
    {
        if (empty($_POST['fid'])) {
            $this->msg('参数传递错误！', 0);
        }
        if (empty($_POST['mid'])) {
            $this->msg('参数传递错误！', 0);
        }
        //录入模型处理
        if (model('expand_model')->field_del($_POST)) {
            $this->msg('字段删除成功！', 1);
        } else {
            $this->msg('字段删除失败', 0);
        }

    }

    //获取内容字段
    public function get_field()
    {
        $cid = intval($_POST['cid']);
        $aid = intval($_POST['aid']);
        if (empty($cid)) {
            return;
        }
        $category_info = model('category')->info($cid);
        if (empty($category_info['expand'])) {
            return;
        }
        //获取字段列表
        $list = model('expand_model')->field_list($category_info['expand']);
        if (empty($list)) {
            return;
        }
        $html = '';
        $info = model('expand_model')->get_file_content($aid, $category_info['expand']);
        foreach ($list as $value) {
            $field_info = model('expand_model')->field_info_id($value['fid']);
            $html .= model('expand_model')->get_field_html($field_info, $info[$value['field']]);

        }
        echo $html;
    }


}

?>