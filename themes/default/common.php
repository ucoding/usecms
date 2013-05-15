<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$common.title}</title>
    <meta name="keywords" content="{$common.keywords}"/>
    <meta name="description" content="{$common.description}"/>
    <@include file="resources.php">
</head>

<body>
<@include file="head.php">
<div id="central">
    <div id="main" class="fn-left">
        <@include file="bread.php">
        <div class="sep10"></div>
        <div class="box  pagelist">
            <div class="boxhead">
                <h3>{$info.name}</h3>
            </div>
            <@body>

            <div class="fn-clear"></div>
        </div>
    </div>
    <div id="sidebar" class="fn-right">
        <@include file="sidebar.php">

    </div>
    <div class="fn-clear"></div>
</div>
<@include file="foot.php">
</body>
</html>
