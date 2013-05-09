<?php
class formMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	$form=substr(in(urldecode($_GET['f'])),0,15);
    	if(empty($form)){
    		$this->error404();
    	}

    	//获取表单信息
    	$info=model('form')->info($form);
    	if(empty($info)||$info['display']==0){
    		$this->error404();
    	}

        /*hook*/
        $this->plus_hook('form','index',$info);
        /*hook end*/

        $this->field_list=model('form')->field_list($info['id']);

    	//分页处理
        $url=__APP__.'/'.$form.'/pages-{page}.html';

        $listrows = $info['page'];
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listrows;
        $limit = $limit_start . ',' . $listrows;

        //导航
        $this->nav=array(
            0=>array('name'=>$info['name'],'url'=>$url),
        );


        //内容列表
        $this->loop=model('form')->form_list($info['table'],$limit,$info['order'],$info['where']);
        //统计总内容数量
        $count=model('form')->form_count($info['table']);
        //分页处理
        $this->page=$this->page($url, $count, $listrows);

        $this->info=$info;
        $this->listrows=$info['page'];
        $this->cur_page=$cur_page;

        //MEDIA信息
        $this->common=model('pageinfo')->media($info['name']);

        //判断使用模板
        if($info['alone_tpl']==0){
        $this->show($info['tpl']);
        }else{
        $this->display($info['tpl']);
        }
    }

    //提交表单
    public function post()
    {
    	$form=in($_POST['form']);
    	if(empty($form)){
    		$this->alert('表单不存在！');
    	}
    	$info=model('form')->info($form);
    	if(empty($info)||$info['display']==0){
    		$this->alert('表单不存在！');
    	}
    	//获取所有字段
    	$field_list=model('form')->field_list($info['id']);
    	if(empty($field_list)){
            $this->alert('未发现表单信息！');
        }

        //过滤机器信息
        if(!empty($_POST['test_value'])){
        	return;
        }

        $data=array();
        foreach ($field_list as $value) {
            if($value['must']==1){
                if(empty($_POST[$value['field']])){
                    $this->alert($value['name'].'不能为空！',0);
                }
            }
            $data[$value['field']]=model('form')->field_in($_POST[$value['field']],$value['type'],$value['field']);
        }

        if ($_POST['checkcode'] != $_SESSION['verify']) {
            $this->alert('验证码错误!');
            return;
        }

        //过滤完后提交表单
        model('form')->add($data,$form);
        $this->alert($info['name'].'提交成功！');
    }

    //验证码
    public function verify(){
        Image::buildImageVerify();
    }


}

?>