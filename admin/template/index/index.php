<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$config.sitename} - DUXCMS网站管理系统</title>
    {$css}
    {$js}
    <link href="__PUBLICURL__/ztree/css/zTreeStyle.css" rel="stylesheet" type="text/css"/>
    <script src="__PUBLICURL__/ztree/jquery.ztree.js"></script>
    <script src="__PUBLICURL__/ztree/jquery.ztree.exhide.js"></script>
    <style>
        html, body {
            overflow: hidden;
        }
    </style>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="50" colspan="2">
            <div id="head">
                <div id="logo"><img src="__PUBLICURL__/images/logo.gif" width="180" height="50"/></div>
                <div class="top_nav">
                    <ul>
                        <li><a href="__APP__/menu/index">首页</a></li>
                        <?php if ($user["id"]!=1) { ?>
                            <!--foreach:{$menu_list $vo}-->
                            <!--if:{in_array($vo['id'],$model_power)}-->
                            <li><a href="__APP__/menu/{$vo['module']}?id={$vo['id']}">{$vo['name']}</a></li>
                            <!--{/if}-->
                            <!--{/foreach}-->
                        <?php }else{ ?>
                            <!--foreach:{$menu_list $vo}-->
                            <li><a href="__APP__/menu/{$vo['module']}?id={$vo['id']}">{$vo['name']}</a></li>
                            <!--{/foreach}-->
                        <?php }?>

                    </ul>
                </div>
                <?php if ($config['LANG_OPEN']) { ?>
                    <div id="lang_tab"><a id="lang" class="menu" href="#">{$lang.name}</a></div>
                <?php } ?>
                <div id="tool"> 欢迎登陆: {$user.user} [{$user.nicename}]&nbsp;&nbsp; <a href="#" onclick="logout()">退出</a>&nbsp;&nbsp;&nbsp;<a
                        href="#" id="cache" class="menu">清除缓存</a>&nbsp;&nbsp;&nbsp;<a href="__ROOTURL__/"
                                                                                      target="_blank">网站首页</a></div>
            </div>
        </td>
    </tr>
    <tr>
        <td width="180" id="page_left" height="100%" align="left" valign="top">
            <!--左边-->
            <div id="nav" class="scroll-pane"></div>
        </td>
        <td height="100%" style="width:100%\9" align="left" valign="top">
            <!--右边-->
            <div style="position:relative; width:100%; height:100%;">
                <div class="loading" id="content_loading" style="display:none"></div>
                <iframe id="main" name="main" src="" frameborder="0"></iframe>
            </div>
        </td>
    </tr>
</table>
</body>
<script>
    var myLayout;
    var pane;
    var root = '__ROOT__';
    $(document).ready(function () {

        //主框架
        function frameheight() {
            var mainheight = $(window).height() - 30;
            $('.scroll-pane').height(mainheight);
        };
        frameheight();
        $(window).resize(frameheight);
        //绑定顶级菜单
        navload();

        //绑定超链接
        hrftload();

        //加载第一页面
        $.get($(".top_nav a:first").attr("href"), function (result) {
            $("#nav").html(result);
        });

        function frameheight() {
            var mainheight = $(window).height() - 70;
            $('#nav').height(mainheight);
        };
        frameheight();
        $(window).resize(frameheight);


        <?php if($config['LANG_OPEN']){ ?>
        //语言切换
        $("#lang").powerFloat({
            width: 80,
            eventType: "click",
            target: [
                <!--foreach:{$lang_list $vo}-->
                {
                    href: "__APP__?lang={$vo.lang}",
                    text: "{$vo.name}"
                }
                <!--if:{count($lang_list)<>$i}-->
                ,
                <!--{/if}-->

                <!--{/foreach}-->
            ],
            targetMode: "list"
        });
        <?php } ?>
        //清除缓存
        $("#cache").powerFloat({
            width: 100,
            eventType: "click",
            target: [
                {
                    href: "javascript:clear('1')",
                    text: "清除所有缓存"
                },
                {
                    href: "javascript:clear('2')",
                    text: "清除模板缓存"
                },
                {
                    href: "javascript:clear('3')",
                    text: "清除静态缓存"
                },
                {
                    href: "javascript:clear('4')",
                    text: "清除数据缓存"
                }
            ],
            targetMode: "list"
        });

    });
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


    //清除缓存
    function clear(type) {
        var url;
        switch (type) {
            case '1':
                url = "__APP__/cache/clear_all";
                break;
            case '2':
                url = "__APP__/cache/clear_tpl";
                break;
            case '3':
                url = "__APP__/cache/clear_html";
                break;
            case '4':
                url = "__APP__/cache/clear_data";
                break;
        }


        $.get(url, function (json) {
            $.dialog.tips(json.message, 3);
            $('#floatBox_list').hide();
        }, 'json');
    }

</script>
</html>