<?php
//内容替换管理
class replaceMod extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }

	public function index() {
        $this->list=model('replace')->replace_list();
		$this->show();  
	}

	//添加
	public function add() {
		$this->show(); 
	}

	public function add_save() {
        $_POST['content']=html_in($_POST['content']);
        //录入模型处理
        if(model('replace')->add($_POST)){
        	$this->msg('内容替换添加成功！',1);
        }else{
        	$this->msg('内容替换添加失败',0);
        }
	}

    //修改
    public function edit() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        
        $this->info=model('replace')->info($id);
        $this->show(); 
    }

    //修改数据
    public function edit_save() {
        $_POST['content']=html_in($_POST['content']);
        
        //录入模型处理
        if(model('replace')->edit($_POST)){
            $this->msg('内容替换修改成功! ',1);
        }else{
            $this->msg('内容替换修改失败! ',0);
        }
    }

    //删除
    public function del() {
        $id=intval($_POST['id']);
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        //录入模型处理
        if(model('replace')->del($id)){
            $this->msg('内容替换删除成功！',1);
        }else{
            $this->msg('内容替换删除失败',0);
        }
    }
	

	

}