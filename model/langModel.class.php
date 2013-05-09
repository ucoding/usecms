<?php
class langModel extends commonMod {

	public function __construct()
    {
        parent::__construct();
    }

    //获取当前语言
    public function langid() {

        if($this->config['LANG_OPEN']){
        $lang=in(__LANG__);
        }else{
            return 1;
        }
        $condition['lang']=$lang;
        $info=$this->model->table('lang')->where($condition)->find();
        if(!empty($info)){
            return $info['id'];
        }else{
            return 1;
        }
    }


}