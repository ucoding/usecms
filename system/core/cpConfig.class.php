<?php
//CanPHP框架默认配置
class cpConfig
{
    static public $config = array(
        //应用配置
        'APP' => array(
            //日志和错误调试配置
            'DEBUG' => true, //是否开启调试模式，true开启，false关闭
            'LOG_ON' => false, //是否开启出错信息保存到文件，true开启，false不开启
            'LOG_PATH' => './data/log/', //出错信息存放的目录，出错信息以天为单位存放，一般不需要修改
            'ERROR_URL' => '', //出错信息重定向页面，为空采用默认的出错页面，一般不需要修改

            //网址配置
            'URL_REWRITE_ON' => false, //是否开启重写，true开启重写,false关闭重写
            'URL_MODULE_DEPR' => '/', //模块分隔符，一般不需要修改
            'URL_ACTION_DEPR' => '-', //操作分隔符，一般不需要修改
            'URL_PARAM_DEPR' => '-', //参数分隔符，一般不需要修改
            'URL_HTML_SUFFIX' => '.php', //伪静态后缀设置，例如 .html ，一般不需要修改
            'URL_HTTP_HOST' => '', //设置网址域名，cp2.0添加

            //模块配置
            'MODULE_PATH' => './module/', //模块存放目录，一般不需要修改
            'MODULE_SUFFIX' => 'Mod.class.php', //模块后缀，一般不需要修改
            'MODULE_INIT' => 'init.php', //初始程序，一般不需要修改
            'MODULE_DEFAULT' => 'index', //默认模块，一般不需要修改
            'MODULE_EMPTY' => 'empty', //空模块	，一般不需要修改

            //操作配置
            'ACTION_DEFAULT' => 'index', //默认操作，一般不需要修改
            'ACTION_EMPTY' => '_empty', //空操作，一般不需要修改

            //模型配置
            'MODEL_PATH' => './model/', //模型存放目录，一般不需要修改
            'MODEL_SUFFIX' => 'Model.class.php', //模型后缀，一般不需要修改

            'AUTOLOAD_DIR' => array(), //自动加载扩展目录，cp2.0添加

            'TIMEZONE' => 'PRC', //时区设置，cp2.1添加
        ),

        //数据库配置
        'DB' => array(
            'DB_TYPE' => 'mysql', //数据库类型，一般不需要修改
            'DB_HOST' => 'localhost', //数据库主机，一般不需要修改
            'DB_USER' => 'root', //数据库用户名
            'DB_PWD' => '', //数据库密码
            'DB_PORT' => 3306, //数据库端口，mysql默认是3306，一般不需要修改
            'DB_NAME' => 'cp', //数据库名
            'DB_CHARSET' => 'utf8', //数据库编码，一般不需要修改
            'DB_PREFIX' => 'cp_', //数据库前缀

            //数据库主从配置，cp2.0添加
            'DB_SLAVE' => array() //数据库从机配置，cp2.0添加

        ),

        //模板配置
        'TPL' => array(
            'TPL_TEMPLATE_PATH' => './template/', //模板目录，一般不需要修改
            'TPL_TEMPLATE_SUFFIX' => '.php' //模板后缀，一般不需要修改
        ),
    );

    //获取默认配置
    static public function get($name = '')
    {
        if (isset(self::$config[$name])) {
            return self::$config[$name];
        } else if (isset(self::$config['APP'][$name])) {
            return self::$config['APP'][$name];
        } else if (isset(self::$config['DB'][$name])) {
            return self::$config['DB'][$name];
        } else if (isset(self::$config['TPL'][$name])) {
            return self::$config['TPL'][$name];
        } else {
            return false;
        }
    }

    //设置参数
    static public function set($name, $value = array())
    {
        return self::$config[$name] = $value;
    }
}