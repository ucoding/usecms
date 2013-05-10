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
            <div class="boxcontent">
                <form action="__APP__/search" method="get">
        <span class="select">
        <select name="model">
            <option value="0"
            <@if:{$info['model']==0}> selected="selected" <@/if> >标题</option>
            <option value="1"
            <@if:{$info['model']==1}> selected="selected" <@/if> >标题和描述</option>
            <option value="2"
            <@if:{$info['model']==2}> selected="selected" <@/if> >全文</option>
        </select>
        </span>
                    <input name="keyword" type="text" id="keyword" value="{$info.name}"/>
                    <button type="submit">搜索</button>
                </form>
            </div>
            <div class="boxlist">
                <ul>
                    <@foreach:{$loop $vo}>
                    <li><span class="line">•</span> <span class="title"><a href="{$vo.aurl}">{$vo.titlex}</a> </span>
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
