<div class="page_function">
    <div class="info">
        <h3>页面片段管理</h3>

    </div>
    <div class="exercise">
        <a href="javascript:menuload('__URL__/add')">添加页面片段</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="30%">描述</th>
                <th width="30%">
                    <center>标识</center>
                </th>
                <th width="30%">
                    <center>操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>{$vo.title}</td>
                <td>
                    <center>{$vo.sign}</center>
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
    //页面片段
    function del(id, obj) {
        var obj;
        ajaxpost(
            '删除此页面片段？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>