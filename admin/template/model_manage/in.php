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
        <h3>模型导入</h3>

    </div>
</div>
<div class="page_form">
    <form action="__URL__/in_data/time-<?php echo time() ?>-ajax-1" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100">模型文件夹名称</td>
                    <td width="300">
                        <input name="table" type="text" class="text_value" id="table" value=""/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        请将下载到的模型目录上传到网站目录下的"data/module"目录下
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="msg">
                        准备导入中...
                    </td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
            <button type="submit" class="button">开始导入</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    var api = frameElement.api;
    saveform(
        function (msg) {
            $('.msg').html('<span style="color:#F00">' + msg + '</span>');
            api.reload();
            api.close();
        },
        function (msg) {
            $('.msg').html('<span style="color:#F00">' + msg + '</span>');
        }
    );
</script>
</body>
</html>
