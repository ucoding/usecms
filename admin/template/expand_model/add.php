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
        <h3>模型添加</h3>

    </div>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="120">模型名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="模型名称不能为空"/>
                    </td>
                </tr>
                <tr>
                    <td width="120">模型表名称</td>
                    <td width="300">
                        <input name="table" type="text" class="text_value" id="table" value="" reg="[a-zA-Z_]"
                               msg="模型表名只能为英文和下划线"/>
                    </td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
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
