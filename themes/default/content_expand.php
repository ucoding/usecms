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
        <div id="pagenav">
            <@include file="bread.php">
        </div>
        <div class="sep10"></div>
        <div class="box  pagecontent">
            <div class="contentexpand">
                <div class="imagebox">
                    <div class="pic">
                        <img id="index_pic" src="{$info.image}" width="320" height="240" alt="{$info.title}"/>
                    </div>
                    <div class="tabs">
                        <?php $pic_list = unserialize($info['listpic']);
                        if (!empty($info['listpic'])) foreach ($pic_list as $value) {
                            ?>
                            <a href="javascript:;" onclick="expand_pic(this)"><img name="" src="{$value.url}" width="85"
                                                                                   height="70"
                                                                                   alt="{$value.title}"/></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="info">
                    <div class="title"><h1>{$info.title}</h1></div>
                    <div class="description">{$info.description}</div>
                    <div class="list">
                        <ul>
                            <li><span class="name">价格：</span>{$info.price}</li>
                            <li><span class="name">型号：</span>{$info.pattern}</li>
                        </ul>
                    </div>
                </div>
                <div class="fn-clear"></div>
            </div>
            <div class="boxcontent">


                <div class="content">{$info.content}</div>
            </div>
            <div class="pagenum">{$page}</div>
            <div class="updown">
                <div class="previous">
                    上一篇：
                    <@if:{empty($prev)}>
                    暂无
                    <@else>
                    <a href="{$prev.aurl}">{$prev.title}</a>
                    <@/if>
                </div>
                <div class="next">
                    下一篇
                    <@if:{empty($next)}>
                    暂无
                    <@else>
                    <a href="{$next.aurl}">{$next.title}</a>
                    <@/if>
                </div>
            </div>
            <div class="boxhead">
                <h3>其他产品</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="content" rand="true" cid="<$category.cid>" limit="10"}>
                    <li><span class="line">•</span> <span class="title"><a href="{$list.aurl}" title="{$list.title}">{$list.title
                                len="25"}</a> </span></li>
                    <@/list>
                </ul>
            </div>
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
<script>
    function expand_pic(obj) {
        $('#index_pic').attr('src', $(obj).children().attr('src'));
        $('#index_pic').attr('alt', $(obj).children().attr('alt'));
    }
</script>
</body>
</html>
