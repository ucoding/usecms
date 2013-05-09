<?php
//表单管理
class form_listMod extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }

	public function index() {

        $id=intval($_GET['id']);
        if(empty($id)){
            $this->msg('参数传递错误! ',0);
        }
        //分页处理

        //分页信息
        $url = __URL__ . '/index/id-' . $id . '-page-{page}.html'; //分页基准网址
        $listRows = 20;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listRows;
        $limit = $limit_start . ',' . $listRows;

        $this->info=model('form')->info($id);

        //内容列表
        $list=model('form_list')->form_list($id,$limit,$this->info['order']);
        //统计总内容数量
        $count=model('form_list')->count($id);
        //分页处理
        $page = $this->page($url, $count, $listRows);

        //表单信息
        $this->assign('field_list',model('form_list')->field_list($id));
		$this->assign('list',$list);
		$this->show();
	}

    //表单添加
    public function add() {
        $id=$_GET['id'];
        if(empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $field_list=model('form')->field_list($id);
        $this->assign('info',model('form')->info($id));
        $this->assign('field_list',$field_list);
        $this->show();
    }

    //表单数据处理
    public function add_save() {
        if(empty($_POST['fid'])){
            $this->msg('参数传递错误！',0);
        }
        //获取所有字段
        $field_list=model('form_list')->list_lod($_POST['fid']);
        if(empty($field_list)){
            $this->msg('未发现表单字段！',0);
        }
        $data=array();
        foreach ($field_list as $value) {
            if($value['must']==1){
                if(empty($_POST[$value['field']])){
                    $this->msg($value['name'].'不能为空！',0);
                }
            }
            $_POST[$value['field']]=model('expand_model')->field_in($_POST[$value['field']],$value['type'],$value['field']);
        }
        //处理完毕后交由模型处理数据
        $id=model('form_list')->add($_POST);
        if($id){
            //录入附件表
            model('upload')->relation('form',$_POST['file_id'],$id);
            $this->msg('添加成功！',1);
        }else{
            $this->msg('添加失败',0);
        }

    }

    //表单编辑
    public function edit() {
        $fid=$_GET['fid'];
        $id=$_GET['id'];
        if(empty($fid)||empty($id)){
            $this->msg('参数传递错误！',0);
        }
        $field_list=model('form')->field_list($fid);
        $this->form_info=model('form')->info($fid);
        $this->info=model('form_list')->info($id,$this->form_info['table']);
        $this->file_id=model('upload')->get_relation('form',$id);
        $this->assign('field_list',$field_list);
        $this->show();
    }

    //编辑数据
    //内容编辑数据处理
    public function edit_save() {
        if(empty($_POST['id'])||empty($_POST['fid'])){
            $this->msg('参数传递错误！',0);
        }
        //获取所有字段
        $field_list=model('form_list')->list_lod($_POST['fid']);
        if(empty($field_list)){
            $this->msg('未发现表单字段！',0);
        }
        $data=array();
        foreach ($field_list as $value) {
            if($value['must']==1){
                if(empty($_POST[$value['field']])){
                    $this->msg($value['name'].'不能为空！',0);
                }
            }
            $_POST[$value['field']]=model('expand_model')->field_in($_POST[$value['field']],$value['type'],$value['field']);
        }
        //处理完毕后交由模型处理数据
        if(model('form_list')->edit($_POST)){
            //录入附件表
            model('upload')->relation('form',$_POST['file_id'],$_POST['id']);
            $this->msg('编辑成功！',1);
        }else{
            $this->msg('编辑失败',0);
        }

    }

    //删除
    public function del() {
        $id=$_POST['id'];
        $fid=$_POST['fid'];
        if(empty($id)||empty($fid)){
            $this->msg('参数传递错误！',0);
        }
        if(model('form_list')->del($id,$fid)){
            model('upload')->del_file('form',$id);
            $this->msg('内容删除成功！',1);
        }else{
            $this->msg('内容删除失败',0);
        }
    }


}