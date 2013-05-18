<div class="page_function">
    <div class="info">
        <h3>系统信息</h3>
    </div>
    <!--[if lt IE 8]-->
    <div class="index_tip"><p>您正在使用IE6或IE7为了您更好的体验，请升级浏览器至IE8以上或者更换其他浏览器<a
        href="http://www.microsoft.com/china/windows/internet-explorer/" target="_blank">Internet Explorer 8</a>
        其他浏览器:
        <a href="http://www.mozillaonline.com/">Firefox</a> / <a
            href="http://www.google.com/chrome/?hl=zh-CN">Chrome</a> / <a
            href="http://www.apple.com.cn/safari/">Safari</a>
        / <a href="http://www.operachina.com/">Opera</a></p></div>
    <!--[endif]-->
</div>
<div class="page_main">
    <h3>基本信息</h3>

    <div class="page_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">当前模板:</td>
                <td width="250">{$config_array['TPL_TEMPLATE_PATH']}</td>
                <td width="120">伪静态:</td>
                <td><?php if ($config_array['URL_REWRITE_ON']) {
                        echo '<font color=green>已开启</font>';
                    } else {
                        echo '<font
                        color=red>未开启</font>';
                    } ?>
                </td>
            </tr>
            <tr>
                <td width="120">缓存状态:</td>
                <td width="250">
                    <?php if ($config_array['TPL_CACHE_ON']) {
                        echo '<font title="已开启" color=green>模板</font>';
                    } else {
                        echo
                        '<font title="未开启" color=red>模板</font>';
                    } ?>
                    &nbsp;&nbsp;
                    <?php if ($config_array['DB_CACHE_ON']) {
                        echo '<font title="已开启" color=green>数据</font>';
                    } else {
                        echo '<font
                        title="未开启" color=red>数据</font>';
                    } ?>
                    &nbsp;&nbsp;
                    <?php if ($config_array['HTML_CACHE_ON']) {
                        echo '<font title="已开启" color=green>静态</font>';
                    } else {
                        echo
                        '<font title="未开启" color=red>静态</font>';
                    } ?>
                </td>
            </tr>
            <tr>
                <td width="120">栏目数:</td>
                <td width="250">{$category_count}</td>
                <td width="120">内容数:</td>
                <td>{$content_count}</td>
            </tr>

        </table>
    </div>

    <h3>环境信息</h3>

    <div class="page_table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">操作系统:</td>
                <td width="150">{$php(echo PHP_OS;)}</td>
                <td width="120">服务器地址:</td>
                <td>{$_SERVER.SERVER_ADDR}:{$_SERVER.SERVER_PORT}</td>
            </tr>
            <tr>
                <td>服务器时间:</td>
                <td><?php echo date("Y-m-d G:i T", time()); ?></td>
                <td>WEB服务器:</td>
                <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
            </tr>
            <tr>
                <td>服务器语言:</td>
                <td><?php echo getenv("HTTP_ACCEPT_LANGUAGE"); ?></td>
                <td>PHP版本:</td>
                <td><?php echo PHP_VERSION; ?></td>
            </tr>
            <tr>
                <td>图像处理支持:</td>
                <td><?php if (function_exists("imageline") == 1) {
                        echo '<font color=green><b>√</b></font>';
                    } else {
                        echo '<font color=red><b>×</b></font>';
                    } ?></td>
                <td>Session支持:</td>
                <td><?php if (function_exists("session_start") == 1) {
                        echo '<font color=green><b>√</b></font>';
                    } else {
                        echo '<font color=red><b>×</b></font>';
                    } ?></td>
            </tr>
            <tr>
                <td>脚本运行内存:</td>
                <td><?php echo get_cfg_var("memory_limit") ? get_cfg_var("memory_limit") : "无"; ?></td>
                <td>上传大小限制:</td>
                <td><?php echo get_cfg_var("upload_max_filesize") ? get_cfg_var("upload_max_filesize") : "不允许上传文件"; ?></td>
            </tr>
            <tr>
                <td>POST提交限制:</td>
                <td><?php echo get_cfg_var("post_max_size"); ?></td>
                <td>脚本超时时间:</td>
                <td><?php echo get_cfg_var("max_execution_time"); ?> s</td>
            </tr>
            <tr>
                <td>被屏蔽的函数:</td>
                <td colspan="3"><?php echo get_cfg_var("disable_functions") ? get_cfg_var("disable_functions") : "无"; ?></td>
            </tr>
        </table>
    </div>
</div>