<?php
//tag显示
class tagsMod extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }
	public function index() {
        $tag=urldecode($_GET['tag']);
        if(!is_utf8($tag))
        {
            $tag=auto_charset($tag,'gbk','utf-8');
        }
        
        $tag = msubstr(in($tag),0,20);
        //查找tag信息
        if(!empty($tag)){
        $info=model('tags')->tag_info($tag);
        }else{
            $this->error404();
        }

        //更新点击计数
        model('tags')->views_content($info['id'],$info['click']);

        /*hook*/
        $this->plus_hook('tags','index',$info);
        /*hook end*/

        //分页处理
        $url=__APP__.'/tags-'.$tag.'/pages-{page}.html';

        $listrows = 20;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listrows;
        $limit = $limit_start . ',' . $listrows;

        $nav=array(
            0=>array('name'=>'TAG','url'=>__APP__),
            1=>array('name'=>$tag,'url'=>__APP__.'/tags-'.$tag.'/'),
            );

        //MEDIA信息
        $this->common=model('pageinfo')->media($info['name'].' - TAGS',$tag);

        //内容列表
        $loop=model('tags')->tag_list($info['id'],$limit);

        //统计总内容数量
        $count=model('tags')->tag_count($info['id']);
        //分页处理
        $this->page=$this->page($url, $count, $listrows);

		$this->assign('loop',$loop);
        $this->assign('nav',$nav);
        $this->assign('info', $info);
		$this->display($this->config['TPL_TAGS']);  
	}
	

	

}