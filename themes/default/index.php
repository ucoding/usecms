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
        <div class="mainhead">
            <div class="slideshow fn-left">
                <ul>
                    <@list_pic:{table="content" image="true" position="3" order="updatetime desc" limit="10" }>
                    <li><a href="{$list_pic.aurl}" title="{$list_pic.title}" target="_blank"><img
                                src="{$list_pic.image}" width="300" height="300" alt="{$list_pic.title}"/></a></li>
                    <@/list_pic>
                </ul>
            </div>
            <div class="indexhot">
                <@list:{table="content" position="1" order="updatetime desc" limit="3"}>
                <div class="hotbox">
                    <h2><a href="{$list.aurl}" target="_blank" title="{$list.title}">{$list.title len="20"}</a></h2>

                    <p>{$list.description len="60"}</p>
                </div>
                <div class="sep10"></div>
                <@/list>
                <div class="hotlist">
                    <ul>
                        <@list:{table="content" position="1" order="updatetime desc" limit="3,4"}>
                        <li><span>?</span> <a href="{$list.aurl}" target="_blank" title="{$list.title}">{$list.title
                                len="13"}</a></li>
                        <@/list>
                    </ul>
                </div>
            </div>
            <div class="fn-clear"></div>
        </div>
        <div class="headtitle">
            <h3>图片</h3>
        </div>
        <div class="piclist">
            <ul>
                <@list:{table="content" image="true" order="updatetime desc" limit="4"}>
                <li>
                    <div class="pic"><a href="{$list.aurl}" target="_blank" title="{$list.title}"><img
                                src="{$list.image}" width="130" height="120" alt="{$list.title}"/></a></div>
                    <div class="title"><a href="{$list.aurl}" target="_blank" title="{$list.title}">{$list.title
                            len="12"}</a></div>
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
            <@list:{table="category" att="list" order="cid asc" }>
            <div class="box">
                <div class="boxhead">
                    <h3><a href="{$list.curl}" title="{$list.name}">{$list.name}</a></h3>
                    <span class="more"><a href="{$list.curl}" title="{$list.name}">more</a></span></div>
                <@piclist:{table="content" cid="<$list.cid>" image="true" order="updatetime desc" limit="1"}>
                <div class="boxpic">
                    <div class="pic"><a href="{$piclist.aurl}" target="_blank" title="{$content.title}"><img
                                src="{$piclist.image}" width="110" height="90" alt="{$piclist.title}"/></a></div>
                    <div class="info">
                        <div class="title"><a href="{$piclist.aurl}" target="_blank" title="{$content.title}">{$piclist.title
                                len="12"}</a></div>
                        <p>{$piclist.description len="45"}</p>
                    </div>
                </div>
                <@/piclist>
                <div class="boxlist">
                    <ul>
                        <@content:{table="content" cid="<$list.cid>" order="updatetime desc" limit="8"}>
                        <li><span class="line">•</span> <span class="title"><a href="{$content.aurl}" target="_blank"
                                                                               title="{$content.title}">{$content.title
                                    len="16"}</a> </span> <span class="time">{$content.updatetime time="Y-m-d"}</span>
                        </li>
                        <@/list>
                    </ul>
                </div>
            </div>
            <@if:{$list_i%2==0}>
            <div class="fn-clear"></div>
            <@/if>
            <@/list>
        </div>
    </div>
    <div id="sidebar" class="fn-right">
        <div class="box">
            <div class="boxhead">
                <h3>热门内容</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="content" order="views desc" limit="10"}>
                    <li><span class="num">{$list.i}</span> <span class="title"><a href="{$list.aurl}"
                                                                                  title="{$list.title}">{$list.title
                                len="13"}</a> </span></li>
                    <@/list>
                </ul>
            </div>
        </div>
        <div class="box">
            <div class="boxhead">
                <h3>随机内容</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="content" rand="true" limit="9"}>
                    <li><span class="num">{$list.i}</span> <span class="title"><a href="{$list.aurl}"
                                                                                  title="{$list.title}">{$list.title
                                len="13"}</a> </span></li>
                    <@/list>
                </ul>
            </div>
        </div>
    </div>
    <div class="fn-clear"></div>
</div>
<@include file="common/foot.php">
</body>
</html>
