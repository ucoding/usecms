<?php
//角色数据处理
class user_groupModel extends commonModel
{

    public function __construct()
    {
        parent::__construct();
    }

    //获取角色列表
    public function admin_list()
    {
        $user = model('user')->current_user();
        return $this->model->table('admin_group')->where('grade>=' . $user['grade'])->order('id asc')->select();
    }

    //获取角色内容
    public function info($id)
    {
        return $this->model->table('admin_group')->where('id=' . $id)->find();
    }

    //添加角色内容
    public function add($data)
    {
        return $this->model->table('admin_group')->data($data)->insert();
    }

    //编辑角色内容
    public function edit($data)
    {
        $condition['id'] = intval($data['id']);
        return $this->model->table('admin_group')->data($data)->where($condition)->update();
    }

    //删除角色内容
    public function del($id)
    {
        $this->model->table('admin')->where('gid=' . intval($id))->delete();
        return $this->model->table('admin_group')->where('id=' . intval($id))->delete();
    }


}