<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$config.sitename} - 网站管理系统</title>
    {$css}
    {$js}

    <script>
        var myLayout;
        var pane;
        var root = '__ROOT__';
        $(function () {

            $(".mainmenu:has(ul:not(:empty))").hover(function(){
                $(this).find("ul").show();
            },function(){
                $(this).find("ul").hide();
            });

            //绑定顶级菜单
            navload();

            //绑定超链接
            hrftload();

            //加载第一页面
            main_load($(".top_nav a:first").attr("href"));

            function frameheight() {
                var mainheight = $(window).height();
                $('#right').height(mainheight);
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
                        main_load(url);
                    }
                    return false;
                });
        }

        //AJAX访问
        function main_load(url) {
            $('#content_loading').show();
            $("#main").attr("src", url);
            $("#main").load(function () {
                $('#content_loading').hide();
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
    <div id="logo"><img src="__ADMINRES__/images/logo.gif" width="180" height="50"/></div>
    <div class="top_nav">
        <ul>
            <li class="mainmenu"><a href="__APP__/index/home">首页</a></li>
            <@foreach:{$menu_list $vo}>
            <@if:{in_array($vo['id'],$model_power)}>
            <li class="mainmenu" style="position: relative">
                <a target="main" href="__APP__/{$vo.module}">{$vo['name']}</a>
                <ul>
                <?php
                $sublist=model('menu')->menu_list($vo['id']);
                foreach($sublist as $subitem)
                {
                    if (in_array($vo['id'],$model_power))
                    {

                ?>
                    <li  class="menuitem" style="display: block">
                        <a target="main" href="__APP__/{$subitem.module}">{$subitem.name}</a>
                    </li>
                <?php }}?>

                </ul>
            </li>
            <@/if>
            <@/foreach>
            <li class="mainmenu" style="position: relative">
                <a target="main" href="__APP__/index/home">模块</a>
                <ul>
                    <@foreach:{$formlist $form}>
                    <li class="menuitem" style="display: block">
                        <a target="main" href="__APP__/form_list/index/id-{$form.id}">{$form.name}</a>
                    </li>
                    <@/foreach>
                </ul>
            </li>
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
<!--右边-->
<div id="right" style="height:100%;">
    <div class="loading" id="content_loading" style="display:none"></div>
    <iframe id="main" name="main" src="" frameborder="0"></iframe>
</div>
</body>

</html>