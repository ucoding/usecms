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
默认栏目模板
    </div>
    <div id="sidebar" class="fn-right">
        <div class="box">
            <div class="boxhead">
                <h3>栏目列表</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="category" pid="<$info.cid>" order="cid desc" limit="5"}>
                    <li><span class="title"><a href="{$list.curl}">{$list.name}</a> </span></li>
                    <@/list>
                </ul>
            </div>
        </div>
        <@include file="sidebar.php">
    </div>
    <div class="fn-clear"></div>
</div>
<@include file="foot.php">

</body>
</html>
