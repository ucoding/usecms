<?php
/*
此文件extend.php在cpApp.class.php中默认会加载，不再需要手动加载
用户自定义的函数，建议写在这里

下面的函数是canphp框架的接口函数，
可自行实现功能，如果不需要，可以不去实现

注意：升级canphp框架时，不要直接覆盖本文件,避免自定义函数丢失
*/


//自定义模板标签解析函数
function tpl_parse_ext($template, $config = array())
{
    require_once(dirname(__FILE__) . "/tpl_ext.php");
    $template = template_ext($template, $config);
    return $template;

}


/*
//自定义网址解析函数
function url_parse_ext()
{
    cpApp::$module=trim($_GET['m']);
    cpApp::$action=trim($_GET['a']);
}
*/

//下面是用户自定义的函数

?>