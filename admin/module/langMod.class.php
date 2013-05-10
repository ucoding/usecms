<?php
//语言管理
class langMod extends commonMod
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->assign('list', model('lang')->lang_list());
        $this->show();
    }

    //添加
    public function add()
    {
        $this->show();
    }

    public function add_save()
    {
        //录入模型处理
        $id = model('lang')->add($_POST);
        if (!empty($id)) {
            $this->msg('语言添加成功！', 1);
        } else {
            $this->msg('语言添加失败', 0);
        }
    }

    //修改
    public function edit()
    {
        $id = $_GET['id'];
        if (empty($id)) {
            $this->msg('参数传递错误！', 0);
        }

        $this->info = model('lang')->info($id);
        $this->show();
    }

    public function edit_save()
    {
        // 表单验证
        if (empty($_POST['id'])) {
            $this->msg('参数传递错误！', 0);
            return;
        }
        //录入模型处理
        $id = model('lang')->edit($_POST);
        if (!empty($id)) {
            $this->msg('栏目修改成功! ', 1);
        } else {
            $this->msg('栏目修改失败! ', 0);
        }
    }

    //删除
    public function del()
    {
        $id = intval($_POST['id']);
        if (empty($id)) {
            $this->msg('参数传递错误！', 0);
        }
        //录入模型处理
        $id = model('lang')->del($id);
        if (!empty($id)) {
            $this->msg('语言删除成功！', 1);
        } else {
            $this->msg('语言删除失败', 0);
        }
    }


}