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
<@头部>
<@include file="head.php">
<@END>
<@中部>
<div id="central">
    <div id="main" class="fn-left">
        <@include file="bread.php">
        <div class="sep10"></div>
        <div class="box  pagelist">
            <div class="boxhead">
                <h3>{$info.name}</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@foreach:{$loop $vo}>
                    <li><span class="line">?</span> <span class="title"><a href="{$vo.aurl}">{$vo.titlex}</a> </span>
                        <span class="time">{$vo.updatetime time="Y-m-d"}</span></li>
                    <@/loop>
                </ul>
            </div>
        </div>
        <div class="pagenum">
            {$page}
        </div>
    </div>
    <@边栏>
    <div id="sidebar" class="fn-right">

        <div class="box">
            <div class="boxhead">
                <h3>栏目列表</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@根据顶级栏目ID调用下级栏目>
                    <@list:{table="category" pid="<$top_category.cid>" order="cid desc" limit="5"}>
                    <li><span class="title"><a href="{$list.curl}">{$list.name}</a> </span></li>
                    <@/list>
                </ul>
            </div>
        </div>
        <@include file="sidebar.php">

    </div>
    <@END>
    <div class="fn-clear"></div>
</div>
<@END>

<@底部>
<@include file="foot.php">
<@END>

</body>
</html>
