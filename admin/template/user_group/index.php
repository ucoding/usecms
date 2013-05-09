<div class="page_function">
    <div class="info">
        <h3>管理组管理</h3>
        <small>使用以下功能进行管理组添加操作</small>
    </div>
    <div class="exercise">
        <!--<a href="javascript:menuload('__URL__')">管理组列表</a>-->
        <a href="javascript:menuload('__URL__/add')">添加管理组</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="70%">管理组名称</th>
                <th width="30%">
                    <center>操作</center>
                </th>
            </tr>
            <!--foreach:{$list $vo}-->
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
                <td>{$vo.name}</td>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}">设置</a>
                        | <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a></center>
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
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '删除此用户组会删除用户组下的用户！',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>