<?php
// 定义内核目录
@date_default_timezone_set('PRC');
define('__ADMINDIR__', strtr(dirname(__FILE__), '\\', '/')); //后台目录
define('__ROOTDIR__', str_replace("\\", '/', substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), DIRECTORY_SEPARATOR))));
$root = str_replace(basename($_SERVER["SCRIPT_NAME"]), '', $_SERVER["SCRIPT_NAME"]);
$admindir = explode('/', __ADMINDIR__);
$adminfile = '/' . (end($admindir));
$root = substr($root, 0, -1);
$root = str_replace($adminfile, '', $root);
define('__ROOTURL__', $root); //根URL
define('__ADMINRES__', $root . '/admin/res'); //根公共URL
define('__UPDURL__', $root . '/upload'); //根上传目录
define('__ROOTUPD__', $root . '/public/upload'); //根公共上传
define('__UPDDIR__', __ROOTDIR__ . '/upload'); //根上传目录

require __ROOTDIR__ . '/inc/config.php';
define('CP_PATH', __ROOTDIR__ . '/system/');
require CP_PATH . 'core/cpApp.class.php';

$config['URL_REWRITE_ON'] = false;
$config['TPL_TEMPLATE_PATH'] = 'template/';

define('ROOTAPP', $root);

define('__TPLDIR__', __ROOTDIR__ . '/' . $config['TPL_TEMPLATE_PATH']); //根模板目录


$app = new cpApp($config); //实例化单一入口应用控制类
Lang::init($config); //初始化语言类
// 执行项目
$app->run();

?>