<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$common.title}</title>
    <meta name="keywords" content="{$common.keywords}"/>
    <meta name="description" content="{$common.description}"/>
    <@include file="common/resources.php">
</head>

<body>
<@include file="common/head.php">
<div id="central">
    <div id="main" class="fn-left">
        <div id="pagenav">
            <@include file="common/bread.php">
        </div>
        <div class="headtitle">
            <h3>栏目推荐</h3>
        </div>
        <div class="piclist">
            <ul>
                <@list:{table="content" position="1" cid="4" type="sub" image="true" order="updatetime desc" limit="4"}>
                <li>
                    <div class="pic"><a href="{$list.aurl}"><img src="{$list.image}" width="130" height="120"
                                                                 alt="{$list.title}"/></a></div>
                    <div class="title"><a href="{$list.aurl}" title="{$list.title}">{$list.title len="13"}</a></div>
                </li>
                <@/list>
            </ul>
            <div class="fn-clear"></div>
        </div>
        <div class="sep10"></div>
        <div class="headtitle">
            <h3>栏目列表</h3>
        </div>
        <div id="classbox">
            <@channel:{table="category" att="list" order="cid asc" pid="<$top_category.cid>"}>
            <div class="box">
                <div class="boxhead">
                    <h3><a href="{$channel.curl}" title="{$channel.name}">{$channel.name}</a></h3>
                    <span class="more"><a href="{$channel.curl}" title="{$channel.name}">more</a></span></div>
                <@piclist:{table="content" cid="<$channel.cid>" image="true" order="updatetime desc" limit="1"}>
                <div class="boxpic">
                    <div class="pic"><a href="{$piclist.aurl}" target="_blank" title="{$piclist.title}"><img
                                src="{$piclist.image}" width="110" height="90" alt="{$piclist.title}"/></a></div>
                    <div class="info">
                        <div class="title"><a href="{$piclist.aurl}" target="_blank" title="{$content.title}">
                                {$piclist.title
                                len="12"}</a></div>
                        <p>{$piclist.description len="45"}</p>
                    </div>
                </div>
                <@/piclist>
                <div class="boxlist">
                    <ul>
                        <@content:{table="content" cid="<$channel.cid>" order="updatetime desc" limit="8"}>
                        <li><span class="line">•</span>
                            <span class="title">
                                <a href="{$content.aurl}" target="_blank"
                                                                               title="{$content.title}">
                                    {$content.title len="16"}</a>
                            </span>
                            <span class="time">{$content.updatetime time="Y-m-d"}</span>
                        </li>
                        <@/content>
                    </ul>
                </div>
            </div>
            <@if:{$channel_i%2==0}>
            <div class="fn-clear"></div>
            <@/if>
            <@/channel>
        </div>
    </div>
    <div id="sidebar" class="fn-right">
        <div class="box">
            <div class="boxhead">
                <h3>栏目列表</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="category" pid="<$info.cid>" order="cid desc"}>
                    <li><span class="title"><a href="{$list.curl}">{$list.name}</a> </span></li>
                    <@/list>
                </ul>
            </div>
        </div>
        <@include file="common/sidebar.php">
    </div>
    <div class="fn-clear"></div>
</div>
<@include file="common/foot.php">

</body>
</html>
