<div class="page_function">
    <div class="info">
        <h3>内容替换管理</h3>
        <small>内容替换非永久替换主要用于内容增加内链</small>
    </div>
    <div class="exercise">
        <!--<a href="javascript:menuload('__URL__')">内容替换列表</a>-->
        <a href="javascript:menuload('__URL__/add')">添加内容替换</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="20%">被替换内容</th>
                <th width="30%">
                    <center>替换后内容</center>
                </th>
                <th width="20%">
                    <center>替换次数</center>
                </th>
                <th width="20%">
                    <center>内容替换操作</center>
                </th>
            </tr>
            <!--foreach:{$list $vo}-->
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
                <td>{$vo.key}</td>
                <td>
                    <center>{$vo['content']}</center>
                </td>
                <td>
                    <center>{$vo.num}</center>
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
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '确定要删除此替换？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>