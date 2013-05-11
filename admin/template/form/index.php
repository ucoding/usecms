<div class="page_function">
    <div class="info">
        <h3>表单管理</h3>
        <small>可以添加或者修改表单功能</small>
    </div>
    <div class="exercise">
        <a href="javascript:;" onclick="form_in('__URL__/in')">导入表单</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="30%">表单</th>
                <th width="30%">
                    <center>表单名</center>
                </th>
                <th width="30%">
                    <center>表单操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>{$vo.name}</td>
                <td>
                    <center>{$vo.table}</center>
                </td>
                <td>
                    <center>
                        <a href="__URL__/field_list/id-{$vo.id}">字段管理</a>
                        |
                        <a href="javascript:void(0);" onclick="out('{$vo.id}')">导出</a>
                        |
                        <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a></center>
                </td>
            </tr>
            <@/foreach>
        </table>
    </div>
</div>
<script>
    function form_in(url) {
        urldialog('表单导入', url);
    }
    function out(id) {
        ajaxpost(
            '导出的文件将在网站目录下的"data/form"中，请自行下载！',
            "__URL__/out",
            {id: id},
            1,
            function () {

            }
        );
    }
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '删除模型后会同时删除模型表和内容! ',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>