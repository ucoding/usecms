<div class="page_function">
    <div class="info">
        <h3>扩展模型管理</h3>

    </div>
    <div class="exercise">
        <a href="javascript:;" onclick="add()">添加模型</a>
        <a href="javascript:;" onclick="model_in('__URL__/in')">导入模型</a>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="30%">模型名称</th>
                <th width="30%">
                    <center>模型数据表</center>
                </th>
                <th width="30%">
                    <center>模型操作</center>
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
                        <a href="__URL__/field_list/mid-{$vo.mid}">字段管理</a>
                        | <a href="javascript:void(0);" onclick="edit('{$vo.mid}')">修改</a>
                        | <a href="javascript:void(0);" onclick="out('{$vo.mid}')">导出</a>
                        | <a href="javascript:void(0);" onclick="del('{$vo.mid}',this)">删除</a></center>
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
        urldialog('模型添加', '__URL__/add')
    }
    ;
    //修改
    function edit(url) {
        urldialog('模型编辑', '__URL__/edit/mid-' + url)
    }
    ;
    function model_in(url) {
        urldialog('模型导入', url)
    }
    ;
    function out(mid) {
        ajaxpost(
            '导出的文件将在网站目录下的"data/ext_module"中，请自行下载！',
            "__URL__/out",
            {mid: mid},
            1,
            function () {
            }
        );
    }
    ;
    //删除
    function del(mid, obj) {
        var obj;
        ajaxpost(
            '删除模型后会同时删除模型表和内容! ',
            "__URL__/del",
            {mid: mid},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>