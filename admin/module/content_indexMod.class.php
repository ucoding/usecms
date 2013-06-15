<?php
class content_indexMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    // 内容菜单
    private  function content()
    {
        $this->user = model('user')->current_user();
        $tree = model('menu')->content_menu($this->user['gid']);
        $data = '';
        if (!empty($tree)) {
            foreach ($tree as $value) {
                if (empty($value['admin_content'])) {
                    $url = ' , url:"' . __APP__ . '/' . $value['admin_category'] . '/edit/id-' . $value['cid'] . '-type-content", target:"main" , icon:"' . __ADMINRES__ . '/ztree/css/img/ico2.gif" ';
                } else {
                    if ($value['type'] == 1) {
                        $url = ' , url:"' . __APP__ . '/' . $value['admin_content'] . '/index/id-' . $value['cid'] . '", target:"main" , icon:"' . __ADMINRES__ . '/ztree/css/img/ico3.gif" ';
                    } else {
                        $url = ' , icon:"' . __ADMINRES__ . '/ztree/css/img/ico1.gif" ';
                    }
                }
                if ($value['pw'] == 1) {
                    $purview = ' , isHidden:true ';
                } else {
                    $purview = ' , isHidden:false ';
                }
                $data .= '{cid:' . $value['cid'] . ',pid:' . $value['pid'] . ', name:"' . $value['name'] . '" ' . $url . $purview . ' }, ' . "\n";
            }
            $data .= '{name:" ", isHidden:true  }' . "\n";
        }
        $this->class_tree = $data;
    }

    // 内容列表
    public function index()
    {
        $this->content();
        //广告位
        $position = intval($_GET['position']);
        if (!empty($position)) {
            $positionurl = '-position-' . $position;
        }
        //搜索
        $search = in(urldecode($_GET['search']));
        if (!empty($search)) {
            $search_where = ' A.title like "%' . $search . '%"';
            $search_url = '-search-' . $search;
        }

        //分页信息
        $url = __URL__ . '/index/id-' . $id . '-page-{page}' . $positionurl . $search_url; //分页基准网址
        $listRows = 10;
        $page = new Page();
        $cur_page = $page->getCurPage($url);
        $limit_start = ($cur_page - 1) * $listRows;
        $limit = $limit_start . ',' . $listRows;

        //广告位
        if (!empty($position)) {
            $where = ' C.pid=' . $position;
            //内容列表
            $this->list = model('position')->position_content_list('', $limit, $where, $order, true);
            //内容统计
            $count = model('position')->position_content_count('', $where, true);
        } else {
            if (!empty($search_where)) {
                $where = $search_where;
            } else {
                $where = "A.status=0";
            }
            //内容列表
            $this->list = model('content')->content_list('', $limit, $where, $order, true);
            //内容统计
            $count = model('content')->count('', $where, true);
        }

        $this->assign('page', $this->page($url, $count, $listRows));

        //对内容进行统计
        $this->category_count = model('category')->category_count();
        $this->content_count = model('content')->count('', '', true);
        $this->audit_count = model('content')->count('', 'A.status=0', true);
        $this->position_list = model('position')->position_list();
        $this->category_list = model('category')->category_list();
        $this->model_info = module('content_category')->get_model();
        $this->show();
    }

    //快速修改
    public function edit()
    {
        $id = intval($_GET['id']);
        if (empty($id)) {
            $this->alert('无此栏目数据！');
        }
        $this->info = model('content')->info($id);
        $this->model_info = module('content_category')->get_model();
        $this->class_info = model('category')->info($this->info['cid']);
        $this->category_list = model('category')->category_list();
        $this->position_list = model('position')->position_list();
        $this->position_array = model('position')->relation_array($id);
        $this->tpl_list = model('category')->tpl_list();
        $this->file_id = model('upload')->get_relation('content', $id);

        $this->show();
    }

    //内容保存
    public function edit_save()
    {

        //保存内容信息
        $status = model('content')->edit_save($_POST, false);

        if ($status) {
            $this->msg('内容编辑成功！', 1);
        } else {
            $this->msg('内容编辑失败', 0);
        }

    }

}

?>