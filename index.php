<?php
header("content-type:text/html; charset=utf-8");
@date_default_timezone_set('PRC');
//定义框架目录
define('CP_PATH', dirname(__file__) . '/system/'); //指定内核目录
require(dirname(__file__) . '/inc/config.php');
require(CP_PATH . 'core/cpApp.class.php');

//定义自定义目录
$root = $config['URL_HTTP_HOST'] . str_replace(basename($_SERVER["SCRIPT_NAME"]), '', $_SERVER["SCRIPT_NAME"]);
define('__ROOT__', substr($root, 0, -1));
define('__ROOTDIR__', strtr(dirname(__FILE__), '\\', '/'));

//实例化入口
$app = new cpApp($config);
Lang::init($config);
$app->run();
?>