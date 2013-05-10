<?php
//角色管理
class user_groupMod extends commonMod
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->list = model('user_group')->admin_list();
        $this->show();
    }

    //角色添加
    public function add()
    {
        $this->user = model('user')->current_user();
        //获取栏目树
        $tree = model('menu')->content_menu();
        if (!empty($tree)) {
            $data = '';
            foreach ($tree as $value) {
                $data .= '{cid:' . $value['cid'] . ',pid:' . $value['pid'] . ', name:"' . $value['name'] . '"  ,title:"' . $value['name'] . '" }, ' . "\n";
            }
            $data .= '{name:" ", isHidden:true  }' . "\n";
        }
        $this->class_tree = $data;

        //获取模块权限
        $this->menu_list = model('menu')->menu_list();

        $this->show();
    }

    public function add_save()
    {

        if (!empty($_POST['class_power'])) {
            $_POST['class_power'] = substr($_POST['class_power'], 0, -1);
        }

        if (is_array($_POST['model_power'])) {
            foreach ($_POST['model_power'] as $value) {
                $model_power .= $value . ',';
            }
            $_POST['model_power'] = substr($model_power, 0, -1);
        } else {
            $_POST['model_power'] = '';
        }

        //录入模型处理
        if (model('user_group')->add($_POST)) {
            $this->msg('角色添加成功！', 1);
        } else {
            $this->msg('角色添加失败', 0);
        }
    }

    //角色修改
    public function edit()
    {
        $id = $_GET['id'];
        if (empty($id)) {
            $this->msg('参数传递错误！', 0);
        }

        //角色信息
        $this->info = model('user_group')->info($id);
        $this->user = model('user')->current_user();
        if ($this->info['grade'] < $this->user['grade']) {
            $this->msg('越权操作！', 0);
        }

        //获取栏目树
        $tree = model('menu')->content_menu();
        $class_power = explode(',', $this->info['class_power']);
        $data = '';
        if (!empty($tree)) {
            foreach ($tree as $value) {
                if (!empty($this->info['class_power'])) {
                    if (in_array($value['cid'], $class_power)) {
                        $purview = ' , checked:true ';
                    } else {
                        $purview = ' ';
                    }
                }
                $data .= '{cid:' . $value['cid'] . ',pid:' . $value['pid'] . ',name:"' . $value['name'] . '" ,title:"' . $value['name'] . '" ' . $purview . ' }, ' . "\n";
            }
            $data .= '{name:" ", isHidden:true  }' . "\n";
        }
        $this->class_tree = $data;

        //获取模块权限
        $this->menu_list = model('menu')->menu_list();
        $this->model_power = explode(',', $this->info['model_power']);

        $this->show();
    }

    //角色修改
    public function edit_save()
    {
        if (!empty($_POST['class_power'])) {
            $_POST['class_power'] = substr($_POST['class_power'], 0, -1);
        }

        if (is_array($_POST['model_power'])) {
            foreach ($_POST['model_power'] as $value) {
                $model_power .= $value . ',';
            }
            $_POST['model_power'] = substr($model_power, 0, -1);
        } else {
            $_POST['model_power'] = '';
        }

        //录入模型处理
        $id = model('user_group')->edit($_POST);
        if (!empty($id)) {
            $this->msg('角色修改成功! ', 1);
        } else {
            $this->msg('角色修改失败! ', 0);
        }
    }

    //角色删除
    public function del()
    {
        $id = intval($_POST['id']);
        if (empty($id)) {
            $this->msg('参数传递错误！', 0);
        }
        $info = model('user_group')->info($id);
        if ($info['keep'] == 1) {
            $this->msg('内置角色无法删除！', 0);
        }
        $this->user = model('user')->current_user();
        if ($info['grade'] < $this->user['grade']) {
            $this->msg('越权操作！', 0);
        }
        //录入模型处理
        $id = model('user_group')->del($id);
        if (!empty($id)) {
            $this->msg('角色删除成功！', 1);
        } else {
            $this->msg('角色删除失败', 0);
        }
    }


}