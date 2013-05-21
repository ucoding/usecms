<?php
require(dirname(__file__) . '/db.php'); //载入附加信息
require(dirname(__file__) . '/siteinfo.php'); //载入附加信息

//全局开关
$config['LANG_OPEN']=false; //多国语言开关

//模板设置
$config['TPL_TEMPLATE_PATH'] = 'themes/default/'; //模板目录，一般不需要修改
$config['TPL_INDEX'] = 'index.php';
$config['TPL_COMMON'] = 'common.php';
$config['TPL_SEARCH'] = 'search.php';

//上传设置
$config['ACCESSPRY_SIZE']='1024'; //附件大小，单位K
$config['ACCESSPRY_NUM']='300'; //上传数量
$config['ACCESSPRY_TYPE']='jpg,bmp,gif,png,flv,mp4,mp3,wma,mp4,7z,zip,rar,ppt,txt,pdf,xls,doc,swf,wmv,avi,rmvb,rm'; //上传格式
$config['THUMBNAIL_SWIHCH'] = true; //是否缩图
$config['THUMBNAIL_MAXWIDTH']='200'; //缩图最大宽度
$config['THUMBNAIL_MAXHIGHT']='140'; //最大高度

//调试配置
$config['DEBUG']=false; //是否开启调试模式，true开启，false关闭
$config['ERROR_HANDLE']=false; //是否启动CP内置的错误处理，如果开启了xdebug，建议设置为false

//伪静态
$config['URL_REWRITE_ON']=true; //是否开启重写，true开启重写,false关闭重写
$config['URL_MODULE_DEPR'] = '/'; //模块分隔符
$config['URL_ACTION_DEPR'] = '/'; //操作分隔符
$config['URL_PARAM_DEPR'] = '-'; //参数分隔符
$config['URL_HTTP_HOST'] = ''; //设置网址域名


//多国语言
$config['LANG_PACK_PATH'] = './lang/'; //语言包目录

