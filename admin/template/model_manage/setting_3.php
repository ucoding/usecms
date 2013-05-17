<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {$css}
    {$js}
</head>
<body scroll="no">
<div class="page_function">
    <div class="info">
        <h3>{$info.name}修改</h3>
        <small>使用以下功能进行模型修改操作</small>
    </div>
</div>
<div class="page_form">
    <form action="__URL__/setting_save/time-<?php echo time() ?>-ajax-1" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="120">栏目URL</td>
                    <td width="300">
                        <input name="url_category" type="text" class="text_value" id="url_category"
                               value="{$info.url_category}" reg="\S" msg="栏目URL不能为空"/>
                    </td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
            <input name="mid" type="hidden" value="{$info.mid}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    var api = frameElement.api;
    saveform(
        function () {
            api.reload();
            api.close();
        }
    );

</script>
</body>
</html>