<?php
class userModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //当前用户信息
    public function current_user()
    {
        $uid = cp_decode($_SESSION[$this->config['SPOT'] . '_user'], $this->config['DB_PREFIX']);
        if (empty($uid)) {
            return;
        }
        $user = $this->model->table('admin')->where('id=' . $uid)->find();
        $user_group = $this->model->table('admin_group')->where('id=' . $user['gid'])->find();
        $user['gname'] = $user_group['name'];
        $user['model_power'] = $user_group['model_power'];
        $user['class_power'] = $user_group['class_power'];
        $user['status_power'] = $user_group['status_power'];
        $user['grade'] = $user_group['grade'];
        $user['keep'] = $user_group['keep'];
        return $user;
    }

    //获取用户列表
    public function admin_list()
    {
        $user = $this->current_user();
        $data = $this->model->field('A.*,B.name as gname')
            ->table('admin', 'A')
            ->add_table('admin_group', 'B', 'A.gid = B.id')
            ->where('B.grade>=' . $user['grade'])
            ->order('id asc')
            ->select();
        return $data;

    }

    //获取用户内容
    public function info($id)
    {
        return $this->model->table('admin')->where('id=' . $id)->find();
    }

    //检测重复用户
    public function count($user, $id = null)
    {
        if (!empty($id)) {
            $where = ' AND id<>' . $id;
        }
        return $this->model->table('admin')->where('user="' . $user . '"' . $where)->count();
    }

    //添加用户内容
    public function add($data)
    {
        return $this->model->table('admin')->data($data)->insert();
    }

    //编辑用户内容
    public function edit($data)
    {
        $condition['id'] = intval($data['id']);
        $id = $this->model->table('admin')->data($data)->where($condition)->update();
        return $id;
    }

    //删除用户内容
    public function del($id)
    {
        return $this->model->table('admin')->where('id=' . intval($id))->delete();
    }

}

?>