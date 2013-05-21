<?php

class model_manageModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    // 模型列表
    public function model_list()
    {
        return $this->model->table('model')->order('mid asc')->select();
    }

    //模型信息
    public function info($id)
    {
        return $this->model->table('model')->where('mid=' . $id)->find();
    }

    //查找模型信息
    public function search($model)
    {
        return $this->model->table('model')->where('model="' . $model . '"')->find();
    }

}

?>