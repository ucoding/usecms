<div class="page_function">
    <div class="info">
        <h3>程序升级</h3>
        <small>通过升级包来进行程序的升级</small>
    </div>
</div>

<div class="page_form page_table form_table">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>
            <td width="120">程序版本</td>
            <td width="300">{$config.ver_name}&nbsp;&nbsp;{$config.ver}</td>
            <td></td>
        </tr>
        <tr>
            <td width="120">内核版本</td>
            <td width="300"><?php echo CP_VER ?></td>
            <td></td>
        </tr>
        <tr>
            <td width="120">发布时间</td>
            <td width="300">{$config.ver_date}</td>
            <td></td>
        </tr>
        <tr>
            <td width="120"><strong>自动更新</strong></td>
            <td width="300"></td>
            <td></td>
        </tr>
        <tr>
            <td width="120">检测最新版本</td>
            <td colspan="2" id="get_ver"><a href="javascript:void(0)" onclick="get_ver()">开始检查</a>(由于网速原因检测速度会有差异)</td>
        </tr>
        <input name="updatefile" id="updatefile" type="hidden" value=""/>
        <input name="file" id="file" type="hidden" value=""/>
        <tr>
            <td width="120"><strong>手动更新</strong></td>
            <td width="300"></td>
            <td></td>
        </tr>
        <tr>
            <td width="120">更新操作</td>
            <td colspan="2">请先将下载到的更新文件解压到网站根目录data/update/目录下，上传前如果有文件请先清空目录下的内容，然后<a href="javascript:void(0)"
                                                                                       onclick="update()">执行本操作</a></td>
        </tr>

    </table>

</div>
<script>
    //检测版本
    function get_ver() {
        $('#get_ver').html('更新获取中，请稍后...');
        $.dialog.tips('更新获取中，请稍后...', 3);
        $.ajax({
            type: 'POST',
            url: '__URL__/get_ver',
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    $('#get_ver').html(json.message + ' <a href="javascript:void(0)" onclick="get_auto()">是否进行自动更新文件？(请确认您的网站环境支持ZIP解压)</a>');
                    $('#updatefile').val(json.file);
                } else {
                    $('#get_ver').html(json.message + ' <a href="javascript:void(0)" onclick="get_ver()">重新检查</a>');
                }

            }
        });
    }
    //自动更新文件
    function get_auto() {
        $('#get_ver').html('正在执行自动更新，请稍后...');
        $.dialog.tips('1/3更新下载中，请稍后...', 60);
        $.ajax({
            type: 'POST',
            url: '__URL__/get_file',
            data: {file: $('#updatefile').val()},
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    $('#file').val(json.message);
                    decompression();
                } else {
                    $.dialog.tips(json.message, 3);
                    $('#get_ver').html(json.message + ' <a href="javascript:void(0)" onclick="get_auto()">重新执行更新</a>');
                }

            }
        });
    }

    //解压
    function decompression() {
        $.dialog.tips('2/3更新文件下载成功，正在执行解压操作', 60);
        file = $('#file').val();
        $.ajax({
            type: 'POST',
            url: '__URL__/decompression',
            data: {
                file: file
            },
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    update()
                } else {
                    $.dialog.tips(json.message, 3);
                    $('#get_ver').html(json.message + ' <a href="javascript:void(0)" onclick="decompression()">重新执行解压操作</a>');
                }

            }
        });
    }
    //升级
    function update() {
        $.dialog.tips('3/3正在执行升级操作', 60);
        $.ajax({
            type: 'POST',
            url: '__URL__/upgrade',
            dataType: "json",
            success: function (json) {
                if (json.status == 1) {
                    $.dialog.tips(json.message, 3);
                } else {
                    $.dialog.tips(json.message, 3);
                    $('#get_ver').html(json.message + ' <a href="javascript:void(0)" onclick="decompression()">重新执行升级操作</a>');
                }
            }
        });
    }


</script>