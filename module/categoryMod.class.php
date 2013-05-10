<?php
class categoryMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cid = intval($_GET['cid']);
        if (empty($cid)) {
            $this->error404();
        }

        //读取栏目信息
        $this->info = model('category')->info($cid);
        if (!is_array($this->info)) {
            $this->error404();
        }
        //模块自动纠正
        model('category')->model_jump($this->info['mid'], 'category');

        /*hook*/
        $this->plus_hook('category', 'index', $this->info);
        $hook_replace = $this->plus_hook('content', 'index_replace', $this->info, true);
        if (!empty($hook_replace)) {
            $this->info = $hook_replace;
        }
        /*hook end*/

        //位置导航
        $this->nav = array_reverse(model('category')->nav($this->info['cid']));

        //设置分页
        $size = intval($this->info['page']);
        if (empty($size)) {
            $listrows = 10;
        } else {
            $listrows = $size;
        }
        $model_info = model('category')->model_info($this->info['mid']);
        $url = model('category')->url_format($model_info['url_category_page'], $cid, $this->info['urlname']);
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listrows;
        $limit = $limit_start . ',' . $listrows;

        //设置栏目属性

        if ($this->info['type'] == 0) {
            $son_id = model('category')->getcat($this->info['cid']);
            $where = 'A.status=1 AND B.cid in (' . $son_id . ')';
        } else {
            $where = 'A.status=1 AND B.cid=' . $this->info['cid'];
        }


        //设置栏目排序
        switch ($this->info['list_sort']) {
            case '1':
                $list_sort = 'A.aid ASC';
                break;
            case '2':
                $list_sort = 'A.time DESC';
                break;
            case '3':
                $list_sort = 'A.time ASC';
                break;
            case '4':
                $list_sort = 'A.views DESC';
                break;
            case '5':
                $list_sort = 'A.views ASC';
                break;

            default:
                $list_sort = 'A.aid DESC';
                break;
        }

        //执行查询
        $this->loop = model('category')->content_list($cid, $where, $limit, $list_sort);
        $count = model('category')->content_count($cid, $where);

        //查询上级栏目信息
        $this->parent_category = model('category')->info($this->info['pid']);
        if (!$this->parent_category) {
            $this->parent_category = array(
                "cid" => "0",
                "pid" => "0",
                "mid" => "0",
                "name" => "无上级栏目");
        }
        //获取分页
        $this->page = $this->page($url, $count, $listrows);
        //获取上一页代码
        $this->prepage = $this->page($url, $count, $listrows, '', 1);
        //获取下一页代码
        $this->nextpage = $this->page($url, $count, $listrows, '', 2);

        $this->count = $count;

        //MEDIA信息
        $this->common = model('pageinfo')->media($this->info['name'], $this->info['keywords'], $this->info['description']);

        //获取顶级栏目信息
        $this->top_category = model('category')->info($this->nav[0]['cid']);
        $this->display($this->info['class_tpl']);
    }


}

?>