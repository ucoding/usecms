<div class="page_function">
    <div class="info">
        <h3>{$info.name}字段管理</h3>

    </div>
    <div class="exercise">
        <a href="javascript:;" onclick="add()">添加字段</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>顺序</center>
                </th>
                <th width="20%">字段描述</th>
                <th width="30%">
                    <center>字段名</center>
                </th>
                <th width="20%">
                    <center>类型</center>
                </th>
                <th width="20%">
                    <center>字段操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <center>{$vo.sequence}</center>
                </td>
                <td>{$vo.name}</td>
                <td>
                    <center>{$vo.field}</center>
                </td>
                <td>
                    <center>{$vo.type_name}</center>
                </td>
                <td>
                    <center>
                        <a href="javascript:;" onclick="edit({$vo.id})">修改</a>
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
    //添加
    function add() {
        urldialog('字段添加', '__URL__/field_add/fid-{$info.id}')
    }
    ;
    //修改
    function edit(id) {
        urldialog('字段编辑', '__URL__/field_edit/id-' + id)
    }
    ;
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '删除此字段将删除字段下的内容！ ',
            "__URL__/field_del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>