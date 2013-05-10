<div class="page_function">
    <div class="info">
        <h3>附件管理</h3>
        <small>管理各个模块的附件</small>
    </div>
    <div class="exercise">
    </div>
</div>
<div class="page_main">
    <div class="page_menu">
        &nbsp;&nbsp;
        文件格式：
        <select onchange="javascript:location.href=this.value;">
            <option value="__URL__/">全部</option>
            <option value="__URL__/index/ext-1" <?php if ($_GET['ext'] == 1) { ?> selected="selected" <?php } ?>  >图片
            </option>
            <option value="__URL__/index/ext-2" <?php if ($_GET['ext'] == 2) { ?> selected="selected" <?php } ?>  >媒体
            </option>
            <option value="__URL__/index/ext-3" <?php if ($_GET['ext'] == 3) { ?> selected="selected" <?php } ?>  >文档
            </option>
            <option value="__URL__/index/ext-4" <?php if ($_GET['ext'] == 4) { ?> selected="selected" <?php } ?>  >压缩
            </option>
            <option value="__URL__/index/ext-5" <?php if ($_GET['ext'] == 5) { ?> selected="selected" <?php } ?>  >其他
            </option>
        </select>
        &nbsp;&nbsp;
        所属模块：
        <select onchange="javascript:location.href=this.value;">
            <option value="__URL__/">全部模块</option>
            <option
                value="__URL__/index/type-no"  <?php if ($_GET['type'] == 'no') { ?> selected="selected" <?php } ?>  >
                未关联模块
            </option>
            <@foreach:{$module_list $vo}>
            <option
                value="__URL__/index/type-{$vo.type}" <?php if ($_GET['type'] == $vo['type']) { ?> selected="selected" <?php } ?> >
                {$vo.name}
            </option>
            <@/foreach>
        </select>
        &nbsp;&nbsp;
        搜索：
        <input name="search" type="text" class="text_value" id="search"
               value="<?php echo urldecode($_GET['search']) ?>"/>
        &nbsp;&nbsp;<input type="button" class="button_small"
                           onclick="javascript:location.href='__URL__/index/id-{$class_info.cid}-search-'+$('#search').val();"
                           value="搜索"/>
    </div>

    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%">
                    <center>ID</center>
                </th>
                <th width="35%">
                    文件名称
                </th>
                <th width="25%">上传时间</th>
                <th width="15%">
                    模块
                </th>
                <th width="15%">
                    <center>附件操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <center>{$vo.id}</center>
                </td>
                <td>
                    <?php if ($vo['ext'] == 'jpg' || $vo['ext'] == 'jpeg' || $vo['ext'] == 'gif' || $vo['ext'] == 'bmp' || $vo['ext'] == 'png') { ?>
                        <a href="javascript:;" rel="{$vo.file}" class="class_pic">{$vo.title}</a>
                    <?php } else { ?>
                        {$vo.title}
                    <?php } ?>
                </td>
                <td>{$vo.time time="Y-m-d H:i:s"}</td>
                <td>{$vo.type}</td>
                <td>
                    <center>
                        <a href="javascript:void(0);" onclick="del('{$vo.id}',this)">删除</a></center>
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
    //缩略图
    $(".class_pic").powerFloat({
        targetMode: "ajax"
    });
    //删除
    function del(id, obj) {
        var obj;
        ajaxpost(
            '确定要删除此附件？',
            "__URL__/del",
            {id: id},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>