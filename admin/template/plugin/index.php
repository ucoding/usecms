<div class="page_function">
    <div class="info">
        <h3>插件管理</h3>
        <small>用来管理程序的附加功能</small>
    </div>
    <div class="exercise">
        <!--<a href="javascript:menuload('__URL__/index')">插件列表</a>-->
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">名称</th>
                <th width="20%">文件</th>
                <th width="10%">作者</th>
                <th width="15%">版本</th>
                <th width="10%">说明</th>
                <th width="15%">状态</th>
                <th width="15%">操作</th>
            </tr>
            <!--foreach:{$list $vo}-->
            <tr>
                <td>{$vo.name}</td>
                <td>{$vo.file}</td>
                <td>{$vo.author}</td>
                <td>{$vo.ver}</td>
                <td><a href="javascript:void(0)" onclick="info('{$vo.file}')">查看</a></td>
                <td>
                    <?php if (empty($vo['status'])) { ?>
                        <a href="javascript:void(0)" onclick="status(1,'{$vo['id']}')" style="color:#F00">未启用</a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" onclick="status(0,'{$vo['id']}')">已启用</a>
                    <?php } ?>
                </td>
                <td>

                    <?php if (!empty($vo['id'])) { ?>
                        <a href="javascript:void(0)" onclick="out('{$vo['id']}')">导出</a> |
                        <a href="javascript:void(0)" onclick="uninstall('{$vo['id']}')">卸载</a>
                    <?php } else { ?>
                        <a style="color:#F00" href="javascript:void(0)" onclick="install('{$vo.file}')">安装</a>
                    <?php } ?>
                </td>
            </tr>
            <!--{/foreach}-->
        </table>
    </div>
</div>

<div class="page_tool">
    <div class="page"></div>
</div>
<script>
    //插件信息
    function info(name) {
        urldialog('插件信息', '__URL__/info/name-' + name);
    }
    ;
    //安装插件
    function install(name) {
        ajaxpost(
            '确认要安装此插件吗？',
            '__URL__/install',
            {name: name},
            0,
            function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        );
    }
    //导出插件
    function out(id) {
        ajaxpost(
            '导出将会导出插件的数据库信息，导出后可以直接打包插件目录',
            "__URL__/out",
            {id: id},
            1,
            function () {
            }
        );
    }
    ;
    //卸载插件
    function uninstall(id) {
        ajaxpost(
            '确认要删除此插件吗？卸载将不可恢复! ',
            '__URL__/uninstall',
            {id: id},
            0,
            function (msg) {
                del_file(msg);
            }
        );
    }
    //删除文件
    function del_file(name) {
        ajaxpost(
            '卸载插件成功，是否删除文件？ ',
            '__URL__/del_file',
            {name: name},
            0,
            function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            },
            function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            },
            function () {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        );
    }

    //状态
    function status(status, id) {
        if (status == 1) {
            url = "__URL__/enable";
        } else {
            url = "__URL__/disable";
        }
        ajaxpost(
            '确定要更改插件状态？',
            url,
            {id: id},
            1,
            function () {
                window.location.reload();
            },
            function () {
                window.location.reload();
            }
        );

    }

</script>