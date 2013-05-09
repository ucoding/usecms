<div class="page_function">
    <div class="info">
        <h3>广告位管理</h3>
        <small>管理内容的广告位置</small>
    </div>
    <div class="exercise">
        <!--<a href="javascript:menuload('__URL__')">广告位列表</a>-->
        <a href="javascript:menuload('__URL__/add')">添加广告位</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="40%">名称</th>
                <th width="20%">
                    <center>顺序</center>
                </th>
                <th width="20%">
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
                    <center>{$vo.sequence}</center>
                </td>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}">修改</a>
                        |
                        <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a></center>
                </td>
            </tr>
            <!--{/foreach}-->
        </table>
    </div>
</div>

<div class="page_tool">
    <div class="page">{$page}</div>
</div>
<script>
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '确定要删除此广告位？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>