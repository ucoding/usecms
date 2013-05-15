<?php
class pages_categoryMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取栏目模型
    public function get_model()
    {
        return model('model_manage')->search('pages');
    }


    //栏目添加
    public function add()
    {
        $this->category_list = model('category')->category_list();
        $this->tpl_list = model('category')->tpl_list();
        $this->show();
    }

    //栏目保存
    public function add_save()
    {
        if (empty($_POST['class_tpl'])) {
            $this->msg('栏目模板未选择！', 0);
        }
        $model = $this->get_model();
        $_POST['mid'] = $model['mid'];
        $_POST['type'] = 0;

        $cid = model('category')->add_save($_POST);
        if ($cid) {
            $_POST['cid'] = $cid;
            model('pages_category')->page_save($_POST);

            $this->msg('页面添加成功！', 1);
        } else {
            $this->msg('页面添加失败！', 0);
        }
    }

    //栏目编辑
    public function edit()
    {
        $id = intval($_GET['id']);
        $content = $_GET['type'];
        if (empty($id)) {
            $this->alert('无此页面数据！');
        }
        $this->category_list = model('category')->category_list();
        $this->info = model('category')->info($id);
        $this->page_info = model('pages_category')->page_info($this->info['cid']);
        $this->tpl_list = model('category')->tpl_list();
        $this->file_id = model('upload')->get_relation('category', $id);
        if ($content == 'content') {
            $this->show("pages_category/edit-content");
        } else {
            $this->show();
        }

    }

    //栏目保存
    public function edit_save()
    {
        if (empty($_POST['cid'])) {
            $this->msg('无法定位栏目ID！', 0);
        }

//        if (empty($_POST['class_tpl'])) {
//            $this->msg('栏目模板未选择！', 0);
//        }

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

        if (model('category')->edit_save($_POST)) {
            model('pages_category')->edit_save($_POST);

            $this->msg('页面编辑成功！', 1);
        } else {
            $this->msg('页面编辑失败！', 0);
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
        $class_status = model('category')->del($_POST['cid']);
        model('pages_category')->del($_POST['cid']);

        if ($class_status) {
            $this->msg('页面删除成功！', 1);
        } else {
            $this->msg('页面删除失败！', 0);
        }
    }


}

?>