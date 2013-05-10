<?php
//登录记录
class logModel extends commonModel
{

    public function __construct()
    {
        parent::__construct();
    }

    //获取登录列表
    public function log_list($limit)
    {
        $data = $this->model->field('A.*,B.user')
            ->table('admin_log', 'A')
            ->add_table('admin', 'B', 'A.uid = B.id')
            ->order('A.id DESC')
            ->limit($limit)
            ->select();
        return $data;
    }

    //获取登录总数
    public function count()
    {
        $data = $this->model->field('A.*,B.user')
            ->table('admin_log', 'A')
            ->add_table('admin', 'B', 'A.uid = B.id')
            ->order('A.id DESC')
            ->count();
        return $data;
    }


    //登录记录
    public function login_log($info)
    {
        $loginnum = $this->model->table('admin_log')->count();
        if ($loginnum > 299) {
            $this->model->table('admin_log')->where(1)->order('id asc')->limit(1)->delete();
        }
        $log_data['uid'] = $info['id'];
        $log_data['time'] = time();
        $log_data['ip'] = get_client_ip();
        $this->model->table('admin_log')->data($log_data)->insert();
    }


}