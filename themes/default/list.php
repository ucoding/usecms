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
        <@include file="common/bread.php">
        <div class="sep10"></div>
        <div class="box  pagelist">
            <div class="boxhead">
                <h3>{$info.name}</h3>
            </div>
            <div class="boxlist">
                    <@con:{table="content" cid="<$info.cid>" order="cid desc" limit="20"}>

                    <div class="boxcontent">
                        <h1>{$con.title}</h1>

                        <div class="info">作者：{$con.copyfrom}&nbsp;&nbsp;浏览量：{$con.views}&nbsp;&nbsp;发布时间：{$con.updatetime
                            time="Y-m-d h:i:s"}&nbsp;&nbsp;{$con.keywords tag}
                        </div>
                        <div class="content">
                            <?php $content = model('content')->info_content($con["aid"]);
                            echo $content["content"];
                            //                                print_r($content);
                            ?>
                        </div>
                    </div>
                    <@/con>
            </div>
        </div>
        <div class="pagenum">
            {$page}
        </div>
    </div>
    <div id="sidebar" class="fn-right">

        <div class="box">
            <div class="boxhead">
                <h3>栏目列表</h3>
            </div>
            <div class="boxlist">
                <ul>
                    <@list:{table="category" pid="<$top_category.cid>" order="cid desc"}>
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
