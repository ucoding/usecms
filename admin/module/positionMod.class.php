<?php
//推荐位管理
class positionMod extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }

    //首页
	public function index() {
        //获取推荐位列表
        $this->list=model('position')->position_list();
		$this->show();  
	}

    //添加
    public function add() {
        $this->show();
    }

    public function add_save() {
        $_POST['sequence']=intval($_POST['sequence']);
        //录入模型处理
        $id=model('position')->add($_POST);
        if(!empty($id)){
            $this->msg('推荐位添加成功！',1);
        }else{
            $this->msg('推荐位换添加失败',0);
        }
    }

    //修改
    public function edit() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $this->info=model('position')->info($id);
        $this->show();
    }

    public function edit_save() {
        // 表单验证
        if (empty($_POST['id']))
        {
            $this->msg('参数传递错误！',0);
            return;
        }
        $_POST['sequence']=intval($_POST['sequence']);        
        //录入模型处理
        if(model('position')->edit($_POST)){
            $this->msg('推荐位修改成功! ',1);
        }else{
            $this->msg('推荐位修改失败! ',0);
        }
    }

    //删除
    public function del() {
        $id=intval($_POST['id']);
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        //录入模型处理
        if(model('position')->del($id)){
            $this->msg('推荐位删除成功！',1);
        }else{
            $this->msg('推荐位删除失败',0);
        }
    }

}