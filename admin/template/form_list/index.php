<div class="page_function">
    <div class="info">
        <h3>{$info.name}管理</h3>
        <small>可以添加或者修改{$info.name}</small>
    </div>
    <div class="exercise">
        <a href="javascript:menuload('__URL__/add/id-{$info.id}')">{$info.name}添加</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <@foreach:{$field_list $vo}>
                <th>
                    <center>{$vo.name}</center>
                </th>
                <@/foreach>
                <th>
                    <center>表单操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
                <@foreach:{$field_list $model}>
                <td>
                    <center>
                        <?php
                        if ($model['admin_html'] <> '') {
                            eval(html_out(str_replace('{content}', $vo[$model['field']], $model['admin_html'])));
                        } else {
                            echo model('expand_model')->get_list_model($model['type'], $vo[$model['field']], $model['config']);
                        }
                        ?>
                    </center>
                </td>
                <@/foreach>
                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.id}-fid-{$info.id}">修改</a>
                        |
                        <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a>
                    </center>
                </td>
            </tr>
            <@/foreach>
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
            '确定要删除此替换？',
            "__URL__/del",
            {id: id, fid: {$info.id}
    }
    ,
    1,
        function () {
            $(obj).parent().parent().parent().remove();
        }
    )
    ;
    }
</script>