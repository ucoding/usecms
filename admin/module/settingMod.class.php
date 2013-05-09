<?php
class settingMod extends commonMod
{
    public function __construct()
    {
        parent::__construct();
    }

    // 显示系统设置页面
    public function index()
    {
        require (__ROOTDIR__.'/inc/config.php'); 
        $this->config_array=$config;
        $this->show();
    }

    // 修改系统设置
    public function save()
    {
        $config = $_POST; //接收表单数据
        $config_array = array();
        foreach ($config as $key => $value) {
        $config_array["config['" . $key . "']"] = $value;
        }
        $status=model('setting')->save($config_array);
        if($status){
            $this->msg('网站配置成功！',1);
        }else{
            $this->msg('网站配置失败，可能由于配置文件权限或路径问题！',0);
        }
    }

}
?>