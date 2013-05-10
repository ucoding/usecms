<div class="page_function">
    <div class="info">
        <h3>{$class_info.name} - 内容管理</h3>
        <small>使用以下功能进行内容操作</small>
    </div>
    <div class="exercise">
        <a href="__URL__/add/cid-{$class_info.cid}">添加内容</a>
    </div>
</div>
<div class="page_main">
    <div class="page_menu">
        &nbsp;&nbsp;
        内容排序：
        <select id="sequence" onchange="javascript:location.href=this.value;">
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-1" <?php if ($_GET['sequence'] == 1) { ?> selected="selected" <?php } ?> >
                更新时间 新->旧
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-2" <?php if ($_GET['sequence'] == 2) { ?> selected="selected" <?php } ?> >
                更新时间 旧->新
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-3" <?php if ($_GET['sequence'] == 3) { ?> selected="selected" <?php } ?> >
                内容ID 大->小
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-4" <?php if ($_GET['sequence'] == 4) { ?> selected="selected" <?php } ?> >
                内容ID 小->大
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-5" <?php if ($_GET['sequence'] == 5) { ?> selected="selected" <?php } ?> >
                添加时间 新->旧
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-6" <?php if ($_GET['sequence'] == 6) { ?> selected="selected" <?php } ?> >
                添加时间 旧->新
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-7" <?php if ($_GET['sequence'] == 7) { ?> selected="selected" <?php } ?> >
                访问次数 多->少
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-sequence-8" <?php if ($_GET['sequence'] == 8) { ?> selected="selected" <?php } ?> >
                访问次数 少->多
            </option>
        </select>
        &nbsp;&nbsp;
        状态：
        <select id="status" onchange="javascript:location.href=this.value;">
            <option
                value="__URL__/index/id-{$class_info.cid}-status-1" <?php if ($_GET['status'] == 1) { ?> selected="selected" <?php } ?> >
                已发布
            </option>
            <option
                value="__URL__/index/id-{$class_info.cid}-status-2" <?php if ($_GET['status'] == 2) { ?> selected="selected" <?php } ?> >
                未发布
            </option>
        </select>
        &nbsp;&nbsp;
        广告位：
        <select id="position" onchange="javascript:location.href=this.value;">
            <option value="__URL__/index/id-{$class_info.cid}">默认</option>
            <@foreach:{$position_list $vo}>
            <option
                value="__URL__/index/id-{$class_info.cid}-position-{$vo.id}"  <?php if ($_GET['position'] == $vo['id']) { ?> selected="selected" <?php } ?> >
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
                <th width="5%">
                    <center>选择</center>
                </th>
                <th width="5%">
                    <center>ID</center>
                </th>
                <th width="30%">标题</th>
                <th width="10%">
                    <center>审核</center>
                </th>
                <th width="10%">
                    <center>访问量</center>
                </th>
                <th width="20%">
                    <center>更新时间</center>
                </th>

                <th width="20%">
                    <center>操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr id="del_{$vo['aid']}">
                <td>
                    <center><input name="id[]" type="checkbox" id="id[]" value="{$vo['aid']}">
                </td>
                <td>
                    <center>{$vo.aid}</center>
                </td>
                <td><span><a href="<?php echo ROOTAPP ?>/label/admin_aurl/aid-{$vo['aid']}.php" target="_blank">{$vo.title}</a>
        <@if:{$vo['image']<>''}>
        <a href="javascript:void(0);" rel="{$vo.image}" class="class_pic"><img align="AbsMiddle"
                                                                               src="__PUBLICURL__/images/ico/pic.png"
                                                                               width="14" height="14" alt=""/></a>
        <@/if>
        </span>
                    <?php
                    if (!empty($vo['position'])) {
                        $str_list = model('position')->content_list($vo['position']);
                        foreach ($str_list as $value) {
                            echo ' <span class="tags_span">[' . $value['name'] . ']</span>';
                        }
                    }
                    ?>
                    &nbsp;&nbsp;<a class="quickeditor" style=" display:none" href="javascript:;"
                                   onclick="quickeditor('__APP__/content_index/edit/id-{$vo.aid}')">[快速编辑]</a>
                </td>
                <td>
                    <center>
                        <@if:{$vo['status']<>0}>
                        <font color=green><b>√</b></font>
                        <@else>
                        <font color=red><b>×</b></font>
                        <@/if>
                    </center>
                </td>
                <td>
                    <center>{$vo.views}</center>
                </td>
                <td>
                    <center>
                        {$php(echo date('Y-m-d H:i:s',$vo['updatetime']))}
                    </center>
                </td>

                <td>
                    <center>
                        <a href="__URL__/edit/id-{$vo.aid}">修改</a>
                        | <a href="javascript:void(0);" onclick="del('{$vo.aid}',this)">删除</a></center>
                </td>
            </tr>
            <@/foreach>
        </table>
    </div>
</div>

<div class="page_tool">
    <div class="function">
        <input type="button" onclick="javascript:selectall('id[]');" class="button_small" value="全选"/>
        <?php if ($user['status_power'] == 0 || $user['keep'] == 1) { ?>
            <input type="button" onclick="javascript:audit(1);" class="button_small" value="发布"/>
            <input type="button" onclick="javascript:audit(2);" class="button_small" value="草稿"/>
        <?php } ?>
        <input type="button" onclick="javascript:audit(3);" class="button_small" value="删除"/>
        <input type="button" onclick="javascript:$('#mobile').toggle();" class="button_small" value="移动"/>
  
  <span id="mobile" style="display:none">
  			<select name="cid" id="cid">
                <option value="">======选择栏目======</option>
                <@foreach:{$category_list $vo}>
                <option value="{$vo['cid']}"
                        <?php if ($vo['type'] == 0 || $vo['mid'] <> $model_info['mid']){ ?>style="background-color:#ccc"
                        disabled="disabled" <?php } ?>
                    <?php if (!empty($user['class_power']) && $user['keep'] <> 1) {
                        if (!in_array($vo['cid'], explode(',', $user['class_power']))) { ?> style="background-color:#ccc"  disabled="disabled" <?php }
                    } ?> >
                    {$vo['cname']}
                </option>
                <@/foreach>
            </select>
            <input type="button" onclick="javascript:audit(4);" class="button_small" value="确认"/>
  </span>
    </div>
    <div class="page">{$page}</div>
</div>
<script>
    //快速编辑
    $('tr').hover(
        function () {
            $(this).find('.quickeditor').show();
        },
        function () {
            $(this).find('.quickeditor').hide();
        }
    );
    function quickeditor(url) {
        $.dialog({
            title: '快速编辑',
            content: 'url:' + url,
            width: 550,
            height: 570
        })
    }
    //选择
    function selectall(name) {
        $("[name='" + name + "']").each(function () {//反选
            if ($(this).attr("checked")) {
                $(this).removeAttr("checked");
            } else {
                $(this).attr("checked", 'true');
            }
        })
    }
    //批量操作
    function audit(status) {
        var str = "";
        $("[name='id[]']").each(function () {//反选
            if ($(this).attr("checked")) {
                str += $(this).val() + ",";
            }
        })

        ajaxpost(
            '您确认要继续进行操作吗？操作将无法撤销！',
            "__URL__/batch",
            {status: status, id: str, cid: $('#cid').val()},
            1,
            function () {
                window.location.reload();
            }
        );
    }
    //栏目缩略图
    $(".class_pic").powerFloat({
        targetMode: "ajax"
    });
    //删除
    function del(aid, obj) {
        var obj;
        ajaxpost(
            '确认要删除本内容吗?删除无法恢复！',
            "__URL__/del",
            {aid: aid, cid: {$class_info.cid}
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