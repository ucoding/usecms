<?php
class categoryMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    // 分类首页
    public function index()
    {
        $this->model_list = model('model_manage')->model_list();
        $this->list = model('category')->category_list();
        $this->show();
    }

    //排序
    public function sequence()
    {
        $cid = intval($_POST['cid']);
        $sequence = intval($_POST['sequence']);
        model('category')->sequence($cid, $sequence);
        $this->msg('排序成功！');

    }


}

?>