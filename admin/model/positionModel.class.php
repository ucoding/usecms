<?php
class positionModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //广告位列表
    public function position_list()
    {
        return $this->model->table('position')->order('sequence desc')->select();
    }

    //添加广告位关联
    public function add_content_save($list = null, $aid)
    {
        if (empty($list)) {
            return false;
        }
        $list = explode(',', $list);
        foreach ($list as $value) {
            $data['pid'] = $value;
            $data['aid'] = $aid;
            $this->model->table('position_relation')->data($data)->insert();
        }
    }

    //编辑广告位关联
    public function edit_content_save($list, $aid)
    {
        $this->del_content($aid);
        $this->add_content_save($list, $aid);
    }

    //删除内容推荐关联
    public function del_content($aid)
    {
        return $this->model->table('position_relation')->where('aid=' . $aid)->delete();
    }

    //广告位信息
    public function info($id)
    {
        return $this->model->table('position')->where('id=' . $id)->find();
    }

    //获取指定广告位列表
    public function content_list($id)
    {
        return $this->model->table('position')->where('id in(' . $id . ')')->order('sequence desc')->select();
    }

    //获取广告位内容
    public function position_content_list($cid, $limit = null, $where = null, $order = null, $all = false)
    {
        if (!$all) {
            if (empty($cid)) {
                return;
            }
            $where_cid = 'A.cid=' . $cid;
        }
        $data = $this->model->field('A.*,B.name as cname,B.mid,D.admin_content')
            ->table('content', 'A')
            ->add_table('category', 'B', 'A.cid = B.cid')
            ->add_table('position_relation', 'C', 'C.aid = A.aid')
            ->add_table('model', 'D', 'D.mid = B.mid')
            ->order($order . 'A.updatetime DESC,A.aid DESC')
            ->where($where_cid . $where)
            ->limit($limit)
            ->select();
        return $data;

    }

    public function position_content_count($cid, $where = null, $all = false)
    {
        if (!$all) {
            if (empty($cid)) {
                return;
            }
            $where_cid = 'A.cid=' . $cid;
        }
        $data = $this->model->field('A.*,B.name as cname,B.mid')
            ->table('content', 'A')
            ->add_table('category', 'B', 'A.cid = B.cid')
            ->add_table('position_relation', 'C', 'C.aid = A.aid')
            ->where($where_cid . $where)
            ->count();
        return $data;
    }

    //获取广告位数组
    public function relation_array($aid)
    {
        $list = $this->model->table('position_relation')->where('aid=' . $aid)->select();
        if (empty($list)) {
            return false;
        }
        foreach ($list as $value) {
            $position[] = $value['pid'];
        }
        return $position;
    }

    //添加广告位
    public function add($data)
    {
        return $this->model->table('position')->data($data)->insert();
    }

    //编辑广告位
    public function edit($data)
    {
        $condition['id'] = intval($data['id']);
        return $this->model->table('position')->data($data)->where($condition)->update();
    }

    //删除广告位
    public function del($id)
    {
        return $this->model->table('position')->where('id=' . intval($id))->delete();
    }

}

?>