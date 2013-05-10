<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$config.sitename} - 网站管理系统</title>
    {$css}
    {$js}
</head>
<body>
<!--body-->
<div class="fn_clear"></div>
<?php if ($config['DEBUG']) { ?>
    <div id="runtime">
        当前脚本运行时间：<?php module('common')->runtime(); ?> 秒
    </div>
<?php } ?>
</body>
</html>