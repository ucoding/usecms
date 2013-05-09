<?php
class content_indexMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    // 内容列表
    public function index()
    {
        //推荐位        
        $position=intval($_GET['position']);
        if(!empty($position)){
            $positionurl='-position-'.$position;
        }
        //搜索
        $search=in(urldecode($_GET['search']));
        if(!empty($search)){
        $search_where=' A.title like "%' . $search . '%"';
        $search_url='-search-'.$search;
        }

        //分页信息
        $url = __URL__ . '/index/id-' . $id . '-page-{page}'.$positionurl.$search_url.'.html'; //分页基准网址
        $listRows = 20;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listRows;
        $limit = $limit_start . ',' . $listRows;

        //推荐位
        if(!empty($position)){
            $where=' C.pid='.$position;
            //内容列表
            $this->list=model('position')->position_content_list('',$limit,$where,$order,true);
            //内容统计
            $count=model('position')->position_content_count('',$where,true);
        }else{
            if(!empty($search_where)){
                $where=$search_where;
            }else{
                $where="A.status=0";
            }
            //内容列表
            $this->list=model('content')->content_list('',$limit,$where,$order,true);
            //内容统计
            $count=model('content')->count('',$where,true);
        }

        $this->assign('page', $this->page($url, $count, $listRows));

        //对内容进行统计
        $this->category_count=model('category')->category_count();
        $this->content_count=model('content')->count('','',true);
        $this->audit_count=model('content')->count('','A.status=0',true);
        $this->position_list=model('position')->position_list();
        $this->category_list=model('category')->category_list();
        $this->model_info=module('content_category')->get_model();
        $this->show();
    }

    //快速修改
    public function edit()
    {
        $id=intval($_GET['id']);
        if(empty($id)){
            $this->alert('无此栏目数据！');
        }
        $this->info=model('content')->info($id);
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
        //保存内容信息
        $status=model('content')->edit_save($_POST,false);
        /*hook*/
        $this->plus_hook('content','edit');
        /*hook end*/
        if($status){
            $this->msg('内容编辑成功！',1);
        }else{
            $this->msg('内容编辑失败',0);
        }

    }

}

?>