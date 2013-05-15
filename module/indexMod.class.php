<?php
class indexMod extends commonMod
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //MEDIA信息
        $this->common = model('pageinfo')->media();

        $this->display($this->config['TPL_INDEX']);
    }


}