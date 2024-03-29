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
            <div class="guestbook">
                <@foreach:{$loop $list}>
                <div class="list">
                    <div class="content"> {$list.content html}
                        <@if:{!empty($list['reply'])}>
                        <div class="reply">管理员回复：{$list.reply}</div>
                        <@/if>
                    </div>
                    <div class="info">邮箱:{$list.email} &nbsp;&nbsp;昵称:{$list.name}&nbsp;&nbsp;时间:{$list.time time="Y-m-d H:i:s"}
                    </div>
                </div>
                <@/foreach>
                <div class="pagenum">
                    {$page}
                </div>
                <div class="formsub">
                    <form action="__APP__/form/post" method="post">
                        <h5>发布留言</h5>

                        <div class="guest_post">
                            <div class="guest_post_hr"> 昵称：
                                <input name="name" type="text" class="guest_post_text" id="name" value="">
                            </div>
                            <div class="guest_post_hr"> 邮箱：
                                <input class="guest_post_text" name="email" type="text" id="email">
                            </div>
                            <textarea name="content" cols="" rows="" class="guest_post_content" id="content"></textarea>

                            <div class="subdiv"><img src="__APP__/form/verify" alt="如果您无法识别验证码，请点图片更换" width="50"
                                                     height="25"
                                                     border="0" align="top" id="verifyImg" style="margin-left:3px;"
                                                     onClick="fleshVerify()"/>&nbsp;
                                <input style="width:50px;" name="checkcode" type="text" class="guest_post_text"
                                       id="checkcode">
                                <input name="time" type="hidden" id="time" value="<?php echo date('Y-m-d H:i:s') ?>">
                                <input name="form" type="hidden" value="guestbook">
                                <input name="test_value" type="hidden" value="">
                                <input type="submit" class="button" value="提交">
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                fleshVerify();
                function fleshVerify() {
                    var timenow = new Date().getTime();
                    document.getElementById('verifyImg').src = '__APP__/form/verify?' + timenow;
                }
            </script>

            <div class="fn-clear"></div>
        </div>
    </div>
    <div class="fn-clear"></div>
</div>
<@include file="common/foot.php">
</body>
</html>
