<div class="page_function">
    <form action="__APP__/setting/save/time-time()" id="form" name="form" method="post">
        <div class="info">
            <h3>系统设置</h3>

        </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#tab1">站点设置</a>
</div>
<div class="page_form">
    <div class="page_table form_table" id="tab1">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">网站名称</td>
                <td width="300"><input name="sitename" type="text" class="text_value" id="sitename"
                                       value="{$config_array.sitename}"/></td>
                <td>{<span>$</span>sys.sitename}</td>
            </tr>
            <tr>
                <td width="120">网站副标题</td>
                <td width="300"><input name="seoname" type="text" class="text_value" id="seoname"
                                       value="{$config_array.seoname}"/></td>
                <td>{<span>$</span>sys.seoname}</td>
            </tr>
            <tr>
                <td width="120">站点关键词</td>
                <td width="300"><input name="keywords" type="text" class="text_value" id="keywords"
                                       value="{$config_array.keywords}"/></td>
                <td>{<span>$</span>sys.keywords}</td>
            </tr>
            <tr>
                <td width="120">站点描述</td>
                <td width="300"><textarea name="description" class="text_textarea" id="description">{$config_array.description}</textarea>
                </td>
                <td>{<span>$</span>sys.description}</td>
            </tr>
            <tr>
                <td width="120">站长邮箱</td>
                <td width="300"><input name="masteremail" type="text" class="text_value" id="masteremail"
                                       value="{$config_array.masteremail}"/></td>
                <td>{<span>$</span>sys.masteremail}</td>
            </tr>
            <tr>
                <td width="120">版权信息</td>
                <td width="300"><input name="copyright" type="text" class="text_value" id="copyright"
                                       value="{$config_array.copyright}"/></td>
                <td>{<span>$</span>sys.copyright}</td>
            </tr>
        </table>
    </div>
</div>
<div class="form_submit">
    <button type="submit" class="button">保存</button>
</div>
<script type="text/javascript">

    //提交表单
    saveform(function (msg) {
        $.dialog.tips(msg, 3)
    });
    //tab菜单
    $("#tab").idTabs();
</script>