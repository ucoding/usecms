<?php
class indexMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    // 显示管理后台首页
    public function index()
    {

        $this->user = model('user')->current_user();
        //角色信息
        $this->info = model('user_group')->info($this->user["id"]);
        $this->model_power = explode(',', $this->info['model_power']);
        $this->menu_list = model('menu')->menu_list();
        $this->lang = model('lang')->current_lang();
        $this->lang_list = model('lang')->lang_list();
        $this->formlist = model('form')->form_list();
        $this->display();
    }

    // 显示管理后台欢迎页
    public function home()
    {
        require(__ROOTDIR__ . '/inc/config.php');
        $this->config_array = $config;
        $this->user = model('user')->current_user();
        $this->content_count = model('content')->count('', '', true);
        $this->category_count = model('category')->category_count();
        $this->show();
    }


    public function rewrite($filename, $data)
    {
        $filenum = fopen($filename, "w");
        flock($filenum, LOCK_EX);
        fwrite($filenum, $data);
        fclose($filenum);
    }

}

?>