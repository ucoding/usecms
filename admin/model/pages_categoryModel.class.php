<?php
class pages_categoryModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //模型附加表信息
    public function model_ini_data()
    {
        return array(
        );
    }
    //模型文件或文件夹信息
    public function model_ini_file()
    {
        return array(
        );
    }

    //保存单页内容
    public function page_save($data) {
        $data['content']=html_in($data['content']);
        return $this->model->table('category_page')->data($data)->insert();
    }

    //编辑单页内容
    public function edit_save($data) {
        $cid=intval($data['cid']);
        $data['content']=html_in($data['content']);
        return $this->model->table('category_page')->data($data)->where('cid='.$cid)->update();
    }

    //获取单页面内容
    public function page_info($cid) {
        $data['content']=html_in($data['content']);
        return $this->model->table('category_page')->where('cid='.$cid)->find();
    }

    //删除单页面内容
    //栏目删除
    public function del($cid)
    {
        return $this->model->table('category_page')->where('cid='.$cid)->delete(); 
    }


}

?>