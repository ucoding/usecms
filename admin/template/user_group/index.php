<div class="page_function">
    <div class="info">
        <h3>角色管理</h3>
        <small>使用以下功能进行角色添加操作</small>
    </div>
    <div class="exercise">
        <a href="javascript:menuload('__URL__/add')">添加角色</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="70%">角色名称</th>
                <th width="30%">
                    <center>操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
                <td>{$vo.name}</td>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}">设置</a>
                        <@if:{$vo.id!=1}>
                        | <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a>
                        <@{/if}>
                    </center>
                </td>
            </tr>
            <@{/foreach}>
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
            '删除此角色会删除角色下的用户！',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>