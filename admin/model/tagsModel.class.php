<?php
class tagsModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取tag列表
    public function tag_list($limit)
    {
        return $this->model->table('tags')->order('id desc')->limit($limit)->select();
    }

    //获取tag总数
    public function count()
    {
        return $this->model->table('tags')->count();
    }

    //删除tag内容
    public function del($id)
    {
        return $this->model->table('tags')->where('id=' . $id)->delete();
    }

    //添加tag
    public function content_save($keywords, $aid)
    {
        if (empty($keywords)) {
            return false;
        }
        $str = $keywords;
        $str = str_replace('，', ',', $str);
        $str = str_replace(' ', ',', $str);
        $strArray = explode(",", $str);
        foreach ($strArray as $list) {
            if (!empty($list)) {
                $condition['name'] = $list;
                $info = $this->model->table('tags')->where($condition)->find();
                if (empty($info)) {
                    //添加tag
                    $data2 = array();
                    $data2['name'] = $list;
                    $data2['aid'] = $aid;
                    $tid = $this->model->table('tags')->data($data2)->insert();
                    $data_relation['aid'] = $aid;
                    $data_relation['tid'] = $tid;
                    $this->model->table('tags_relation')->data($data_relation)->insert();
                } else {
                    $condition2['aid'] = $aid;
                    $condition2['tid'] = $info['id'];
                    $info_relation = $this->model->table('tags_relation')->where($condition2)->find();

                    if (empty($info_relation)) {
                        $data_relation['aid'] = $aid;
                        $data_relation['tid'] = $info['id'];
                        $this->model->table('tags_relation')->data($data_relation)->insert();
                    }
                }

            }

        }
        return true;
    }

    //删除tag
    public function del_content($aid)
    {

        $list = $this->model->table('tags_relation')->where('aid=' . $aid)->select();
        if (empty($list)) {
            return;
        }
        //删除该内容的TAG关系
        $this->model->table('tags_relation')->where('aid=' . $aid)->delete();
        //查找其他TAG关系
        foreach ($list as $value) {
            $info = $this->model->table('tags_relation')->where('tid=' . $value['tid'])->find();
            if (empty($info)) {
                $this->model->table('tags')->where('id=' . $value['tid'])->delete();
            }

        }

    }

}

?>