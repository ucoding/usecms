<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>后台管理系统</title>
    <script type=text/javascript src="__ADMINRES__/js/jquery.js"></script>
    <script type=text/javascript src="__ADMINRES__/js/duxui.js"></script>
    <script type=text/javascript src="__ADMINRES__/js/common.js"></script>
    <script type=text/javascript src="__ADMINRES__/js/dialog/lhgdialog.min.js?skin=default"></script>
    <link href="__ADMINRES__/css/base.css" rel="stylesheet" type="text/css"/>
    <link href="__ADMINRES__/css/login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="login">
    <h1>管理系统</h1>

    <form action="__URL__/check/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="main">
            <div class="tip">用户名：</div>
            <div class="text"><input name="user" type="text" class="user" id="user" tabindex="1"/></div>
            <div class="tip">密码：</div>
            <div class="text"><input class="password" name="password" type="password" id="password" tabindex="2"/></div>
        </div>
        <div class="button">
            <button type="submit" tabindex="3">登录</button>
            <button type="button" tabindex="4">重置</button>
        </div>
    </form>
    <div class="copyright"><@copyright></div>
</div>
<script type="text/javascript">
    $("#user").focus();
    //提交表单
    saveform(
        function () {
            window.location.href = "__APP__/index";
        },
        function (msg) {
            $.dialog.tips(msg, 3);
        }
    );
</script>
</body>
</html>
