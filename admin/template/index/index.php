<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$config.sitename} - 网站管理系统</title>
    {$css}
    {$js}
    <link href="__PUBLICURL__/ztree/css/zTreeStyle.css" rel="stylesheet" type="text/css"/>
    <script src="__PUBLICURL__/ztree/jquery.ztree.js"></script>
    <script src="__PUBLICURL__/ztree/jquery.ztree.exhide.js"></script>
    <script>
        var myLayout;
        var pane;
        var root = '__ROOT__';
        $(function () {

            //绑定顶级菜单
            navload();

            //绑定超链接
            hrftload();

            //加载第一页面
            $.get($(".top_nav a:first").attr("href"), function (result) {
                $("#nav").html(result);
            });

            function frameheight() {

                var mainheight = $(window).height() - $("#nav").position().top - parseInt($("#nav").css("padding-bottom")) - parseInt($("#nav").css("padding-top"));
                $('#nav,#right').height(mainheight);
            };
            frameheight();
            $(window).resize(frameheight);


            <?php if($config['LANG_OPEN']){ ?>
            //语言切换
            $("#lang").powerFloat({
                width: 80,
                eventType: "click",
                target: [
                    <@foreach:{$lang_list $vo}>
                    {
                        href: "__APP__?lang={$vo.lang}",
                        text: "{$vo.name}"
                    }
                    <@if:{count($lang_list)<>$i}>
                    ,
                    <@/if>

                    <@/foreach>
                ],
                targetMode: "list"
            });
            <?php } ?>

        });

        //绑定顶部ajax菜单
        function navload() {
            $('.top_nav a').live("click",
                function () {
                    var url = $(this).attr("href");
                    if (url !== '' && url !== '#') {
                        $("#nav").load(url);
                    }
                    return false;
                });
        }

        //AJAX访问
        function main_load(url) {
            $('#content_loading').fadeIn(0);
            $("#main").attr("src", url);
            $("#main").load(function () {

                $('#content_loading').fadeOut(1);
            });
        }

        //退出
        function logout() {
            $.dialog({
                title: '退出确认',
                content: '是否退出网站管理系统？ ',
                lock: true,
                button: [
                    {
                        name: '退出',
                        callback: function () {
                            $.ajax({
                                type: 'POST',
                                url: '__APP__/login/logout',
                                data: {
                                    'out': 'true'
                                },
                                dataType: 'json',
                                success: function (json) {
                                    window.location.reload();
                                }

                            });

                        }
                    },
                    {
                        name: '取消'
                    }
                ]
            });
        }

    </script>
</head>
<body>
<div id="head">
    <div id="logo"><img src="__PUBLICURL__/images/logo.gif" width="180" height="50"/></div>
    <div class="top_nav">
        <ul>
            <li class="mainmenu"><a href="__APP__/menu/index">首页</a></li>
            <@foreach:{$menu_list $vo}>
            <@if:{in_array($vo['id'],$model_power)}>
            <li class="mainmenu" style="position: relative">
                <a href="__APP__/menu/{$vo['module']}?id={$vo['id']}">{$vo['name']}</a>

            </li>
            <@/if>
            <@/foreach>

        </ul>
    </div>
    <?php if ($config['LANG_OPEN']) { ?>
        <div id="lang_tab"><a id="lang" class="menu" href="#">{$lang.name}</a></div>
    <?php } ?>
    <div id="tool">
        欢迎登陆: {$user.user} [{$user.nicename}]&nbsp;&nbsp;
        <a href="__ROOTURL__/" target="_blank">网站首页</a> &nbsp;&nbsp;
        <a href="#" onclick="logout()">退出</a>

    </div>
</div>
<!--左边-->
<div id="nav" class="scroll-pane"></div>
<!--右边-->
<div id="right" style="position:relative; height:100%;margin-left: 180px;">
    <div class="loading" id="content_loading" style="display:none"></div>
    <iframe id="main" name="main" src="" frameborder="0"></iframe>
</div>
</body>

</html>