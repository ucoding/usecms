<?php
class contentMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }
    // 内容列表
    public function index()
    {
    	$id=intval($_GET['id']);
    	if(empty($id)){
            $this->alert('无此栏目数据！');
        }

        //排序
        $sequence=intval($_GET['sequence']);
        switch ($sequence) {
            case '1':
                $order='A.updatetime DESC';
                $where_url='1';
                break;
            case '2':
                $order='A.updatetime ASC';
                $where_url='2';
                break;
            case '3':
                $order='A.aid DESC';
                $where_url='3';
                break;
            case '4':
                $order='A.aid ASC';
                $where_url='4';
                break;
            case '5':
                $order='A.inputtime DESC';
                $where_url='5';
                break;
            case '6':
                $order='A.inputtime ASC';
                $where_url='6';
                break;
            case '7':
                $order='A.views DESC';
                $where_url='7';
                break;
            case '8':
                $order='A.views ASC';
                $where_url='8';
                break;
        }
        if(!empty($order)){
        $order=$order.',';
        $where_url='-sequence-'.$where_url;
        }

        //状态
        $status=intval($_GET['status']);
        switch ($status) {
            case '1':
                $where=' AND A.status=1';
                $where_url='1';
                break;
            case '2':
                $where=' AND A.status=0';
                $where_url='2';
                break;
        }
        if(!empty($status)){
        $where_url='-status-'.$where_url;
        }

        //搜索
        $search=in(urldecode($_GET['search']));
        if(!empty($search)){

        $where=' AND A.title like "%' . $search . '%"';
        $where_url='-search-'.$search;
        }

        //栏目信息
        $this->class_info = model('category')->info($id);

        //推荐位
        $position=intval($_GET['position']);
        if(!empty($position)){
            $where_url='-position-'.$position;
        }

        //分页信息
        $url = __URL__ . '/index/id-' . $id . '-page-{page}'.$where_url.'.html'; //分页基准网址
        $listRows = 20;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listRows;
        $limit = $limit_start . ',' . $listRows;

        //推荐位
        if(!empty($position)){
            $where=' AND C.pid='.$position;
            //内容列表
            $this->list=model('position')->position_content_list($id,$limit,$where,$order);
            //内容统计
            $count=model('position')->position_content_count($id,$where);
        }else{
            //内容列表
            $this->list=model('content')->content_list($id,$limit,$where,$order);
            //内容统计
            $count=model('content')->count($id,$where);
        }

        $this->assign('page', $this->page($url, $count, $listRows));
        $this->position_list=model('position')->position_list();
        $this->category_list=model('category')->category_list();
        $this->model_info=module('content_category')->get_model();
        $this->show();
    }

    //内容添加
    public function add()
    {
    	$cid=intval($_GET['cid']);
    	if(empty($cid)){
            $this->alert('无此栏目数据！');
        }

        $this->model_info=module('content_category')->get_model();
        $this->class_info = model('category')->info($cid);
        $this->category_list=model('category')->category_list();
        $this->position_list=model('position')->position_list();
        $this->tpl_list=model('category')->tpl_list();
        //内容来源
        if(!empty($this->model_info['befrom'])){
            $befrom=explode("\n",$this->model_info['befrom']);
            foreach ($befrom as $value) {
                $befrom_list[]=$value;
            }
        }
        $this->befrom_list=$befrom_list;
        
        $this->show();
    }

    //内容保存
    public function add_save()
    {
        /*hook*/
        $hook_replace=$this->plus_hook('content','add_replace',$_POST,true);
        if(!empty($hook_replace)){
            $_POST=$hook_replace;
        }
        /*hook end*/

        //检测扩展字段是否为空
        model('expand_model')->content_check($_POST);

    	//保存内容信息
    	$_POST['aid']=model('content')->add_save($_POST);
    	model('content')->add_content_save($_POST);

        /*hook*/
        $this->plus_hook('content','add');
        /*hook end*/

    	if(!empty($_POST['aid'])){
            $this->msg('内容添加成功！',1);
        }else{
            $this->msg('内容添加失败',0);
        }
    }

    //内容编辑
    public function edit()
    {

        $id=intval($_GET['id']);
        if(empty($id)){
            $this->alert('无此栏目数据！');
        }
        $this->info=model('content')->info($id);
        $this->info_data=model('content')->info_content($id);
        $this->model_info=module('content_category')->get_model();
        $this->class_info = model('category')->info($this->info['cid']);
        $this->category_list=model('category')->category_list();
        $this->position_list=model('position')->position_list();
        $this->position_array=model('position')->relation_array($id);
        $this->tpl_list=model('category')->tpl_list();
        $this->file_id=model('upload')->get_relation('content',$id);

        //内容来源
        if(!empty($this->model_info['befrom'])){
            $befrom=explode("\n",$this->model_info['befrom']);
            foreach ($befrom as $value) {
                $befrom_list[]=$value;
            }
        }
        $this->befrom_list=$befrom_list;

        $this->show();
    }

    //内容保存
    public function edit_save()
    {

        /*hook*/
        $hook_replace=$this->plus_hook('content','edit_replace',$_POST,true);
        if(!empty($hook_replace)){
            $_POST=$hook_replace;
        }
        /*hook end*/

        //检测扩展字段是否为空
        model('expand_model')->content_check($_POST);

        //保存内容信息
        $status=model('content')->edit_save($_POST);
        model('content')->edit_content_save($_POST);

        /*hook*/
        $this->plus_hook('content','edit');
        /*hook end*/

        if($status){
            $this->msg('内容编辑成功！',1);
        }else{
            $this->msg('内容编辑失败',0);
        }

    }
    //内容删除
    public function del()
    {
        if(empty($_POST['aid'])){
            $this->msg('无法定位内容ID！',0);
        }
        /*hook*/
        $this->plus_hook('content','del',$_POST['aid']);
        /*hook end*/

        $status=model('content')->del($_POST['aid']);
        model('content')->del_content($_POST['aid']);

        if($status){
            $this->msg('内容删除成功！',1);
        }else{
            $this->msg('内容删除失败！',0);
        }
    }

    //批量操作
    public function batch(){
        if(empty($_POST['status'])||empty($_POST['id'])){
            $this->msg('请先选择内容！',0);
        }
        $id_array=substr($_POST['id'],0,-1);
        $id_array=explode(',', $id_array);
        switch ($_POST['status']) {
            case '1':
                //审核
                foreach ($id_array as $value) {
                    model('content')->status($value,1);
                }
                break;
            case '2':
                //草稿
                foreach ($id_array as $value) {
                    model('content')->status($value,0);
                }
                break;
            case '3':
                //删除
                foreach ($id_array as $value) {
                    /*hook*/
                    $this->plus_hook('content','del',$value);
                    /*hook end*/
                    
                    model('content')->del($value);
                    model('content')->del_content($value);
                }
                break;
            case '4':
                //转移栏目
                $cid=intval($_POST['cid']);
                if(empty($cid)){
                    $this->msg('请先选择目标栏目！',0);
                }
                foreach ($id_array as $value) {
                    model('content')-> edit_cid($value,intval($_POST['cid']));
                }
                break;
        }
        $this->msg('操作执行完毕！',1);

    }

    //获取关键词
    public function get_keyword(){
        
        $title=$_POST['title'];
        $content=$_POST['content'];
        $keyword=model('content')->get_keyword($title,$content);
        if(!empty($keyword)){
            $this->msg($keyword);
        }else{
            $this->msg('暂时无法获取到关键词！',0);
        }
    }




}

?>