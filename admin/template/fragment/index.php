<div class="page_function">
    <div class="info">
        <h3>自定义变量管理</h3>
        <small>使用以下功能进行自定义变量管理操作</small>
    </div>
    <div class="exercise">
        <!--<a href="javascript:menuload('__URL__')">自定义变量列表</a>-->
        <a href="javascript:menuload('__URL__/add')">添加自定义变量</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="30%">描述</th>
                <th width="30%">
                    <center>标识</center>
                </th>
                <th width="30%">
                    <center>操作</center>
                </th>
            </tr>
            <!--foreach:{$list $vo}-->
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
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
            <!--{/foreach}-->
        </table>
    </div>
</div>

<div class="page_tool">
    <div class="page"></div>
</div>
<script>
    //自定义变量
    function del(id, obj) {
        var obj;
        ajaxpost(
            '删除此自定义变量？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>