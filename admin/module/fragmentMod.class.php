<?php
//自定义变量管理
class fragmentMod extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }

	public function index() {
		$this->list=model('fragment')->fragment_list();
		$this->show();  
	}

	//变量添加
	public function add() {
		$this->show(); 
	}

	public function add_save() {
        $_POST['content']=html_in($_POST['content']);
        //录入模型处理
        $id=model('fragment')->add($_POST);
        //录入附件表
        model('upload')->relation('plus',$_POST['file_id'],$id);
        if(!empty($id)){
        	$this->msg('自定义变量添加成功！',1);
        }else{
        	$this->msg('自定义变量添加失败',0);
        }
	}

    //变量修改
    public function edit() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        
        $this->assign('info',model('fragment')->info($id));
        $this->file_id=model('upload')->get_relation('plus',$id);
        $this->show(); 
    }

    //变量修改
    public function edit_save() {
        $_POST['content']=html_in($_POST['content']);
        //录入模型处理
        if(model('fragment')->edit($_POST)){
            //录入附件表
            model('upload')->relation('plus',$_POST['file_id'],$_POST['id']);
            $this->msg('变量修改成功! ',1);
        }else{
            $this->msg('变量修改失败! ',0);
        }
    }

    //变量删除
    public function del() {
        $id=intval($_POST['id']);
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        //录入模型处理
        if(model('fragment')->del($id)){
            model('upload')->del_file('plus',$id);
            $this->msg('变量删除成功！',1);
        }else{
            $this->msg('变量删除失败',0);
        }
    }
	

	

}