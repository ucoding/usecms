<?php
class content_categoryMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取栏目模型
    public function get_model()
    {
        return model('model_manage')->search('content');
    }


    //栏目添加
    public function add()
    {
        $this->category_list=model('category')->category_list();
        $this->model_list=model('expand_model')->model_list();
        $this->tpl_list=model('category')->tpl_list();
        $this->show();
    }

    //栏目保存
    public function add_save()
    {
        if(empty($_POST['class_tpl'])||empty($_POST['content_tpl'])){
            $this->msg('栏目或内容模板未选择！',0);
        }

        $list = explode("\n", $_POST['namelist']);
        if(empty($list)){
            $this->msg('栏目名称未填写',0);
        }
        $model=$this->get_model();
        $_POST['mid']=$model['mid'];
        foreach ($list as $name) {
            if(empty($name)){
                $this->msg('栏目名称未填写',0);
            }
            $_POST['name']=$name;
            /*hook*/
            $hook_replace=$this->plus_hook('category','add_replace',$_POST,true);
            if(!empty($hook_replace)){
                $_POST=$hook_replace;
            }
            /*hook end*/
            $cid=model('category')->add_save($_POST);
            /*hook*/
            $this->plus_hook('category','add',$cid);
            /*hook end*/
        }
        $this->msg('栏目添加成功！');
    }

    //栏目编辑
    public function edit()
    {
        $id=intval($_GET['id']);
        if(empty($id)){
            $this->alert('无此栏目数据！');
        }
        $this->category_list=model('category')->category_list();
        $this->model_list=model('expand_model')->model_list();
        $this->info=model('category')->info($id);
        $this->tpl_list=model('category')->tpl_list();
        $this->file_id=model('upload')->get_relation('category',$id);
        $this->show();
    }

    //栏目保存
    public function edit_save()
    {
        if(empty($_POST['cid'])){
            $this->msg('无法定位栏目ID！',0);
        }

        if(empty($_POST['class_tpl'])||empty($_POST['content_tpl'])){
            $this->msg('栏目或内容模板未选择！',0);
        }

        // 分类检测
        if ($_POST['pid'] == $_POST['cid']){
            $this->msg('不可以将当前栏目设置为上一级栏目！',0);
            return;
        }
        $cat = model('category')->category_list($_POST['cid']);
        if (!empty($cat)) {
            foreach ($cat as $vo) {
                if ($_POST['pid'] == $vo['cid']) {
                    $this->msg('不可以将上一级栏目移动到子栏目！',0);
                    return;
                }
            }
        }

        $model=$this->get_model();
        $_POST['mid']=$model['mid'];

        /*hook*/
        $hook_replace=$this->plus_hook('category','edit_replace',$_POST,true);
        if(!empty($hook_replace)){
            $_POST=$hook_replace;
        }
        /*hook end*/

        if(model('category')->edit_save($_POST)){
            /*hook*/
            $this->plus_hook('category','edit');
            /*hook end*/
            $this->msg('栏目编辑成功！',1);
        }else{
            $this->msg('栏目编辑失败！',0);
        }
    }

    //栏目删除
    public function del()
    {
        if(empty($_POST['cid'])){
            $this->msg('无法定位栏目ID！',0);
        }
        if(model('category')->list_count($_POST['cid'])){
            $this->msg('请先删除子栏目！',0);
        }
        
        /*hook*/
        $this->plus_hook('category','del');
        /*hook end*/
        $class_status=model('category')->del($_POST['cid']);
        //删除内容
        $list=model('content')->get_list_id($_POST['cid']);
        if($list){
            foreach ($list as $value) {
                model('content')->del($value['aid']);
                model('content')->del_content($value['aid']);
            }
        }
        if($class_status){
            $this->msg('栏目删除成功！',1);
        }else{
            $this->msg('栏目删除失败！',0);
        }
    }


    

}

?>