<div class="page_function">
    <div class="info">
        <h3>栏目类型管理</h3>

    </div>
<!--    <div class="exercise">-->
<!--        <a href="javascript:;" onclick="model_in('__URL__/in')">导入模型</a>-->
<!--    </div>-->
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="30%">模型名称</th>
                <th width="30%">
                    <center>模型标识</center>
                </th>
                <th width="30%">
                    <center>模型操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>{$vo.name}模型</td>
                <td>
                    <center>{$vo.model}</center>
                </td>
                <td>
                    <center>
                        <a href="javascript:void(0);" onclick="edit('__URL__/setting/id-{$vo.mid}')">配置</a>
<!--                        | <a href="javascript:void(0);" onclick="model_out('{$vo.mid}')">导出</a>-->
<!--                        | <a href="javascript:void(0);" onclick="del('{$vo.mid}',this)">删除</a>-->
                    </center>
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
    function edit(url) {
        urldialog('模型配置', url)
    }
    ;
//    function model_in(url) {
//        urldialog('模型导入', url)
//    }
//    ;
//    function model_out(mid) {
//        ajaxpost(
//            '导出的文件将在网站目录下的"data/module"中，请自行下载！',
//            "__URL__/out",
//            {mid: mid},
//            1,
//            function () {
//            }
//        );
//    }
//    ;
//    function del(mid, obj) {
//        ajaxpost(
//            '您确定要删除此模型？删除将不可恢复！',
//            "__URL__/del",
//            {mid: mid},
//            1,
//            function () {
//                $(obj).parent().parent().parent().remove();
//            }
//        );
//    }
//    ;
</script>