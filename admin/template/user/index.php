<div class="page_function">
    <div class="info">
        <h3>管理员管理</h3>

    </div>
    <div class="exercise">
        <a href="javascript:menuload('__URL__/add')">添加管理员</a>
        <a href="__APP__/user_group">角色管理</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="20%">管理员帐号</th>
                <th width="20%">管理员名称</th>
                <th width="20%">角色</th>
                <th width="10%">状态</th>
                <th width="20%">
                    <center>操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>{$vo.user}</td>
                <td>{$vo.nicename}</td>
                <td>{$vo.gname}</td>
                <td>
                    <@if:{$vo['status']==1}>
                    启用
                    <@else>
                    禁用
                    <@/if>
                </td>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}">修改</a>
                        | <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a></center>
                </td>
            </tr>
            <@/foreach>
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
            '确定要删除此管理员吗？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>