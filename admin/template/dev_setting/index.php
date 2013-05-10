<div class="page_function">
    <form action="__APP__/setting/save/time-time()" id="form" name="form" method="post">
        <div class="info">
            <h3>开发设置</h3>
            <small>设置网站的性能等</small>
        </div>
</div>
<div class="tab" id="tab">
    <a href="#tab2">调试设置</a>
</div>
<div class="page_form">

    <div class="page_table form_table" id="tab2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">错误信息输出：</td>
                <td width="300"><?php if ($config_array['DEBUG']) { ?>
                        <input type="radio" name="DEBUG" id="DEBUG" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="DEBUG" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="DEBUG" value="true"/>
                        开启
                        <input type="radio" name="DEBUG" id="DEBUG" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td>开启将会显示详细错误信息</td>
            </tr>
            <tr>
                <td>DEBUG模式：</td>
                <td><?php if ($config_array['ERROR_HANDLE']) { ?>
                        <input type="radio" name="ERROR_HANDLE" id="ERROR_HANDLE" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="ERROR_HANDLE" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="ERROR_HANDLE" value="true"/>
                        开启
                        <input type="radio" name="ERROR_HANDLE" id="ERROR_HANDLE" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td>开启DEBUG模式将会显示严格的调试信息，非开发者请勿开启。</td>
            </tr>
        </table>
    </div>

</div>
<div class="form_submit">
    <button type="submit" class="button">保存</button>
</div>
</form>
</div>
<script type="text/javascript">
    //提交表单
    saveform(function (msg) {
        $.dialog.tips(msg, 3)
    });
    //tab菜单
    $("#tab").idTabs();
</script>