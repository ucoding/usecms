<div class="page_function">
    <div class="info">
        <h3>语言管理</h3>
        <small>用于多国语言的添加与修改和删除</small>
    </div>
    <div class="exercise">
        <a href="javascript:menuload('__URL__/add')">添加语言</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="30%">
                    <center>语言名称</center>
                </th>
                <th width="30%">
                    <center>语言标识</center>
                </th>
                <th width="20%">
                    <center>操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <center>{$vo.name}</center>
                </td>
                <td>
                    <center>{$vo.lang}</center>
                </td>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}">修改</a>
                        | <a href="javascript:void(0);" onclick="del('__URL__/del','{$vo.id}',this)">删除</a></center>
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
    function del(url, id, obj) {
        var obj;
        ajaxpost(
            '删除将不可恢复！ ',
            url,
            {id: id},
            0,
            function (msg) {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>