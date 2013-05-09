<?php
//升级文件
class updateModel extends commonModel {

	public function __construct()
  	{
        parent::__construct();
  	}

  	public function index()
  	{
        //增加数据库
        $sql=" ALTER TABLE {$this->model->pre}content ADD taglink int(10) DEFAULT '0' ";
		$this->model->query($sql);
  	}

}