<?php
class jump_categoryMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取栏目模型
    public function get_model()
    {
        return model('model_manage')->search('jump');
    }

    //栏目添加
    public function add()
    {
        $this->category_list = model('category')->category_list();
        $this->show();
    }

    //栏目保存
    public function add_save()
    {
        $model = $this->get_model();
        $_POST['mid'] = $model['mid'];
        $_POST['type'] = 0;
        /*hook*/
        $hook_replace = $this->plus_hook('category', 'add_replace', $_POST, true);
        if (!empty($hook_replace)) {
            $_POST = $hook_replace;
        }
        /*hook end*/
        $cid = model('category')->add_save($_POST);
        if ($cid) {
            $_POST['cid'] = $cid;
            model('jump_category')->jump_save($_POST);
            /*hook*/
            $this->plus_hook('category', 'add');
            /*hook end*/
            $this->msg('栏目添加成功！', 1);
        } else {
            $this->msg('栏目添加失败！', 0);
        }
    }

    //栏目编辑
    public function edit()
    {
        $id = intval($_GET['id']);
        if (empty($id)) {
            $this->alert('无此栏目数据！');
        }
        $this->category_list = model('category')->category_list();
        $this->info = model('category')->info($id);
        $this->jump_info = model('jump_category')->jump_info($this->info['cid']);
        $this->file_id = model('upload')->get_relation('category', $id);
        $this->show();
    }

    //栏目保存
    public function edit_save()
    {
        if (empty($_POST['cid'])) {
            $this->msg('无法定位栏目ID！', 0);
        }

        // 分类检测
        if ($_POST['pid'] == $_POST['cid']) {
            $this->msg('不可以将当前栏目设置为上一级栏目！', 0);
            return;
        }
        $cat = model('category')->category_list($_POST['cid']);
        if (!empty($cat)) {
            foreach ($cat as $vo) {
                if ($_POST['pid'] == $vo['cid']) {
                    $this->msg('不可以将上一级栏目移动到子栏目！', 0);
                    return;
                }
            }
        }

        $model = $this->get_model();
        $_POST['mid'] = $model['mid'];
        /*hook*/
        $hook_replace = $this->plus_hook('category', 'edit_replace', $_POST, true);
        if (!empty($hook_replace)) {
            $_POST = $hook_replace;
        }
        /*hook end*/
        if (model('category')->edit_save($_POST)) {
            model('jump_category')->edit_save($_POST);
            /*hook*/
            $this->plus_hook('category', 'edit');
            /*hook end*/
            $this->msg('栏目编辑成功！', 1);
        } else {
            $this->msg('栏目编辑失败！', 0);
        }
    }

    //栏目删除
    public function del()
    {
        if (empty($_POST['cid'])) {
            $this->msg('无法定位栏目ID！', 0);
        }
        if (model('category')->list_count($_POST['cid'])) {
            $this->msg('请先删除子栏目！', 0);
        }
        /*hook*/
        $this->plus_hook('category', 'del');
        /*hook end*/
        $class_status = model('category')->del($_POST['cid']);
        model('jump_category')->del($_POST['cid']);

        if ($class_status) {
            $this->msg('栏目删除成功！', 1);
        } else {
            $this->msg('栏目删除失败！', 0);
        }
    }


}

?>