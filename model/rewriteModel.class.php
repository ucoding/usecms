<?php
class rewriteModel extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    //解析栏目
    public function category($dir = null, $page = null)
    {
        $dir = in($dir);
        if (!empty($dir)) {
            $condition['urlname'] = $dir;
            $category = $this->model->field('cid,urlname')->table('category')->where($condition)->find();
            if (empty($category)) {
                $this->error404();
                return;
            } else {
                $_GET['cid'] = $category['cid'];
                $_GET['page'] = intval($page);
                module('category')->index();
                return;
            }
        }
        $this->error404();
        return;
    }

    //解析内容
    public function content($dir = null, $page = null)
    {
        if (is_numeric($dir)) {
            $aid = intval($dir);
        } else {
            $dir = in($dir);
        }
        if (!empty($aid)) {
            $_GET['aid'] = $aid;
            $_GET['page'] = intval($page);
            module('content')->index();
            return;
        }
        if (!empty($dir)) {
            $content = $this->model->field('aid,urltitle')->table('content')->where('urltitle="' . $dir . '"')->find();
            if (empty($content)) {
                $this->error404();
                return;
            } else {
                $_GET['aid'] = $content['aid'];
                $_GET['page'] = intval($page);
                module('content')->index();
                return;
            }
        }
        $this->error404();
        return;
    }

    //解析表单
    public function form_url($table, $page = null)
    {
        if (empty($table)) {
            $this->error404();
        }
        $_GET['f'] = $table;
        if (!empty($page)) {
            $_GET['page'] = $page;
        }
        module('form')->index();
        return;
    }

    //解析TAG
    public function tags_url($tags, $page = null)
    {
        if (empty($tags)) {
            $this->error404();
        }
        $_GET['tag'] = $tags;
        if (!empty($page)) {
            $_GET['page'] = $page;
        }
        module('tags')->index();
        return;
    }


}

?>