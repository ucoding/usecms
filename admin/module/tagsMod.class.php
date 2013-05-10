<?php
//tag管理
class tagsMod extends commonMod
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        //分页处理
        //分页信息
        $url = __URL__ . '/index/page-{page}.html'; //分页基准网址
        $listRows = 50;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listRows;
        $limit = $limit_start . ',' . $listRows;

        //内容列表
        $this->list = model('tags')->tag_list($limit);
        //统计总内容数量
        $count = model('tags')->count();
        $this->assign('page', $this->page($url, $count, $listRows));
        $this->show();
    }

    //tag删除
    public function del()
    {
        $id = intval($_POST['id']);
        if (empty($id)) {
            $this->msg('参数传递错误！', 0);
        }
        //录入模型处理
        if (model('tags')->del($id)) {
            $this->msg('tag删除成功！', 1);
        } else {
            $this->msg('tag删除失败', 0);
        }
    }


}