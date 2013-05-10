<?php
class menuMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }


    //后台首页菜单
    public function index()
    {
        $this->display();
    }

    // 分类菜单
    public function category()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->display();
    }


    public function upload_file()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->display();
    }

    // 内容菜单
    public function content()
    {
        $this->user = model('user')->current_user();
        $tree = model('menu')->content_menu($this->user['gid']);
        $data = '';
        if (!empty($tree)) {
            foreach ($tree as $value) {
                if (empty($value['admin_content'])) {
                    $url = ' , url:"' . __APP__ . '/' . $value['admin_category'] . '/edit/id-' . $value['cid'] . '-type-content", target:"main" , icon:"' . __PUBLICURL__ . '/ztree/css/img/ico2.gif" ';
                } else {
                    if ($value['type'] == 1) {
                        $url = ' , url:"' . __APP__ . '/' . $value['admin_content'] . '/index/id-' . $value['cid'] . '", target:"main" , icon:"' . __PUBLICURL__ . '/ztree/css/img/ico3.gif" ';
                    } else {
                        $url = ' , icon:"' . __PUBLICURL__ . '/ztree/css/img/ico1.gif" ';
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
        $this->display();

    }

    //其他
    public function expand()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->formlist =  model('form')->form_list();
        $this->display();
    }

    //用户管理
    public function user()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->display();
    }

    //开发管理
    public function dev()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->display();
    }

    //系统设置
    public function setting()
    {
        $id = $_GET["id"];
        $this->list = model('menu')->admin_menu($id);
        $this->display();
    }


}

