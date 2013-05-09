<?php
class formMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }
    //表单首页
    public function index()
    {
        $this->list=model('form')->form_list();
        $this->show();
    }

    //表单添加
    public function add() {
        $this->show();
    }

    //表单添加数据处理
    public function add_save() {

        if(model('form')->table_info($_POST['table'])){
            $this->msg('表名不能重复！',0);
        }

        if(model('form')->add($_POST)){
            $this->msg('表单添加成功！',1);
        }else{
            $this->msg('表单添加失败',0);
        }
    }

    //表单修改
    public function edit() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $this->info=model('form')->info($id);
        $this->show();
    }

    //表单修改
    public function edit_save() {

        if(model('form')->table_info($_POST['table'],$_POST['id'])){
            $this->msg('表名不能重复！',0);
        }
        
        //录入模型处理
        $id=model('form')->edit($_POST);
        if(!empty($id)){
            $this->msg('表单修改成功! ',1);
        }else{
            $this->msg('表单修改失败! ',0);
        }
    }

    //模型导入
    public function in()
    {
        $this->display();
    }

    public function in_data(){
        $table=$_POST['table'];
        if(empty($table)){
            $this->msg('文件夹名尚未填写！',0);
        }
        $dir=__ROOTDIR__.'/data/form/'.$table;
        $config = @Xml::decode(file_get_contents($dir.'/form.xml'));
        $config = $config['config'];
        if(empty($config)){
            $this->msg('无法获取模型配置！',0);
        }
        if(!file_exists($dir)||!file_exists($dir.'/dbbak/')){
            $this->msg($table.'目录不存在！或者目录结构错误！',0);
        }
        if(model('form')->table_info($config['table'])){
            $this->msg($table.'模型已经存在，无法重复导入！',0);
        }
        //导入数据库
        $db = new Dbbak($this->config['DB_HOST'],$this->config['DB_USER'],$this->config['DB_PWD'],$this->config['DB_NAME'],'utf8',$dir.'/dbbak/');
        if(!$db->importSql('',$config['prefix'],$this->config['DB_PREFIX'])){
            $this->msg('数据库导入失败！',0);
        }
        //修改关联信息
        $info=model('form')->associate_edit();
        $this->msg('模型导入完毕！',1);

    }

    //模型导出
    public function out()
    {
        $id=intval($_POST['id']);
        $info=model('form')->info($id);
        //创建文件夹
        $dir=__ROOTDIR__.'/data/form/'.$info['table'];
        @mkdir($dir,0777,true);
        if(!file_exists($dir)){
            $this->msg('文件夹创建失败，请保证"/data/form/"有写入权限',0);
        }
        @mkdir($dir.'/dbbak/',0777,true);
        if(!file_exists($dir.'/dbbak/')){
            $this->msg('文件夹创建失败，请保证"/data/form/dbbak/"有写入权限',0);
        }
        $data_array=model('form')->field_list_data($id);
        if(empty($data_array)){
            $this->msg('无法获取多用表单字段',0);
        }
        //导出数据库
        $db = new Dbbak($this->config['DB_HOST'],$this->config['DB_USER'],$this->config['DB_PWD'],$this->config['DB_NAME'],'utf8',$dir.'/dbbak/');

        $sql="INSERT INTO ".$this->config['DB_PREFIX']."form VALUES('', '".mysql_escape_string($info['name'])."', '".mysql_escape_string($info['table'])."','".mysql_escape_string($info['display'])."','".mysql_escape_string($info['page'])."','".mysql_escape_string($info['tpl'])."','".mysql_escape_string($info['alone_tpl'])."','".mysql_escape_string($info['order'])."','".mysql_escape_string($info['where'])."')\n";
        foreach ($data_array as $vo) {
            $sql.="INSERT INTO ".$this->config['DB_PREFIX']."form_field VALUES('', 101010, '".mysql_escape_string($vo['name'])."', '".mysql_escape_string($vo['field'])."', '".mysql_escape_string($vo['type'])."', '".mysql_escape_string($vo['property'])."', '".mysql_escape_string($vo['len'])."', '".mysql_escape_string($vo['decimal'])."', '".mysql_escape_string($vo['default'])."', '".mysql_escape_string($vo['sequence'])."', '".mysql_escape_string($vo['tip'])."', '".mysql_escape_string($vo['config'])."', '".mysql_escape_string($vo['must'])."', '".mysql_escape_string($vo['admin_display'])."', '".mysql_escape_string($vo['admin_html'])."')\n";
        }
        if(!$db->exportSql($this->config['DB_PREFIX'].'form_data_'.$info['table'],0,$sql)){
            $this->msg('数据库导出失败！',0);
        }

        //写入表单信息
        $html='<?xml version="1.0" encoding="utf-8"?>' . PHP_EOL;
        $html.='<config>' . PHP_EOL;
        $html.='<name>'.$info['name'].'</name>' . PHP_EOL;
        $html.='<table>'.$info['table'].'</table>' . PHP_EOL;
        $html.='<prefix>'.$this->config['DB_PREFIX'].'</prefix>' . PHP_EOL;
        $html.='</config>' . PHP_EOL;
        @file_put_contents($dir.'/form.xml',$html);
        if(!file_exists($dir.'/form.xml')){
            $this->msg('表单信息导出失败，请检查目录权限！',0);
        }

        $this->msg('扩展模型导出完毕，请自行到"data/form"中下载文件',1);
        
    }

    //表单删除
    public function del() {
        $id=intval($_POST['id']);
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        //录入模型处理
        $id=model('form')->del($id);
        if(!empty($id)){
            $this->msg('表单删除成功！',1);
        }else{
            $this->msg('表单删除失败',0);
        }
    }

    //表单字段
    public function field_list() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $this->info=model('form')->info($id);
        $this->list=model('form')->field_list($id);
        $this->show();
    }

    //添加字段
    public function field_add(){
        $fid=$_GET['fid'];
        if(empty($fid)){
            $this->msg('参数传递错误！',0);
        }
        $this->info=model('form')->info($fid);
        $this->field_type=model('expand_model')->field_type();
        $this->field_property=model('expand_model')->field_property();
        $this->display();
    }

    //字段添加
    public function field_add_save() {

        if(empty($_POST['fid'])){
            $this->msg('参数传递错误！',0);
        }
        if(model('form')->field_check($_POST['fid'],$_POST['field'])){
            $this->msg('字段名不能重复',0);
        }
        //录入模型处理
        $id=model('form')->field_add($_POST);
        if(!empty($id)){
            $this->msg('字段添加成功！',1);
        }else{
            $this->msg('字段添加失败',0);
        }

    }

    //修改字段
    public function field_edit()
    {
        $id=intval($_GET['id']);
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $this->info=model('form')->field_info($id);
        $this->table_info=model('form')->info($this->info['fid']);
        $this->field_type=model('expand_model')->field_type();
        $this->field_property=model('expand_model')->field_property();
        $this->display();
    }

    //字段数据修改
    public function field_edit_save()
    {
        if(empty($_POST['fid'])){
            $this->msg('参数传递错误！',0);
        }
        if(empty($_POST['id'])){
            $this->msg('参数传递错误！',0);
        }
        if(model('form')->field_check($_POST['fid'],$_POST['field'],$_POST['id'])){
            $this->msg('字段名不能重复',0);
        }
        //录入模型处理
        $id=model('form')->field_edit($_POST);
        if(!empty($id)){
            $this->msg('字段修改成功！',1);
        }else{
            $this->msg('字段修改失败',0);
        }
    }

    //字段删除
    public function field_del()
    {
        //录入模型处理
        $id=model('form')->field_del($_POST);
        if(!empty($id)){
            $this->msg('字段删除成功！',1);
        }else{
            $this->msg('字段删除失败',0);
        }

    }

}

?>