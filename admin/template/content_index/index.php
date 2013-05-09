<div class="page_function">
    <div class="info">
        <h3>内容首页</h3>
        <small>请使用左边菜单对内容进行管理，本功能用于管理条件内容</small>
    </div>
    <div class="tip">栏目总数：{$category_count}个，内容总数：{$content_count}条，未审核内容{$audit_count}条</div>
</div>
<div class="page_main">
    <div class="page_menu">
        &nbsp;&nbsp;
        当前列表：
        <font color=green><?php if (empty($_GET['position']) && empty($_GET['search'])) {
                echo '未审核内容';
            } else {
                echo '筛选内容';
            } ?></font>
        &nbsp;&nbsp;
        广告位：
        <select id="position" onchange="javascript:location.href=this.value;">
            <option value="__URL__">默认</option>
            <!--foreach:{$position_list $vo}-->
            <option
                value="__URL__/index/position-{$vo.id}"  <?php if ($_GET['position'] == $vo['id']) { ?> selected="selected" <?php } ?> >
                {$vo.name}
            </option>
            <!--{/foreach}-->
        </select>
        &nbsp;&nbsp;
        内容标题：
        <input name="search" type="text" class="text_value" id="search"
               value="<?php echo urldecode($_GET['search']) ?>"/>
        &nbsp;&nbsp;<input type="button" class="button_small"
                           onclick="javascript:location.href='__URL__/index/search-'+$('#search').val();" value="搜索"/>
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
                <th width="35%">标题</th>
                <th width="15%">栏目</th>
                <th width="10%">
                    <center>审核</center>
                </th>
                <th width="15%">
                    <center>更新时间</center>
                </th>
                <th width="15%">
                    <center>操作</center>
                </th>
            </tr>
            <!--foreach:{$list $vo}-->
            <tr id="del_{$vo['aid']}">
                <td>
                    <center><input name="id[]" type="checkbox" id="id[]" value="{$vo['aid']}">
                </td>
                <td>
                    <center>{$vo.aid}</center>
                </td>
                <td><span>{$vo.title}</span>
                    <?php
                    if (!empty($vo['position'])) {
                        $str_list = model('position')->content_list($vo['position']);
                        foreach ($str_list as $value) {
                            echo ' <span class="tags_span">[' . $value['name'] . ']</span> ';
                        }
                    }
                    ?>
                    &nbsp;&nbsp;<a class="quickeditor" style=" display:none" href="javascript:;"
                                   onclick="quickeditor('__APP__/content_index/edit/id-{$vo.aid}')">[快速编辑]</a>
                </td>
                <td>
                    <a href="#">{$vo.cname}</a>
                </td>
                <td>
                    <center>
                        <!--if:{$vo['status']<>0}-->
                        <font color=green><b>√</b></font>
                        <!--{else}-->
                        <font color=red><b>×</b></font>
                        <!--{/if}-->
                    </center>
                </td>
                <td>
                    <center>
                        {$php(echo date('Y-m-d H:i:s',$vo['updatetime']))}
                    </center>
                </td>

                <td>
                    <center>
                        <a href="__APP__/{$vo.admin_content}/edit/id-{$vo.aid}">修改</a>
                        | <a href="javascript:void(0);"
                             onclick="del('{$vo.aid}',this,'__APP__/{$vo.admin_content}/del')">删除</a></center>
                </td>
            </tr>
            <!--{/foreach}-->
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
        <input type="button" onclick="javascript:$('#mobile').toggle();" class="button_small" value="移动"/>
  <span id="mobile" style="display:none">
  			<select name="cid" id="cid">
                <option value="">======选择栏目======</option>
                <!--foreach:{$category_list $vo}-->
                <option value="{$vo['cid']}"
                        <?php if ($vo['type'] == 0 || $vo['mid'] <> $model_info['mid']){ ?>style="background-color:#ccc"
                        disabled="disabled" <?php } ?>
                    <?php if (!empty($user['class_power']) && $user['keep'] <> 1) {
                        if (!in_array($vo['cid'], explode(',', $user['class_power']))) { ?> style="background-color:#ccc"  disabled="disabled" <?php }
                    } ?> >
                    {$vo['cname']}
                </option>
                <!--{/foreach}-->
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
            "__APP__/content/batch",
            {status: status, id: str, cid: $('#cid').val()},
            1,
            function () {
                window.location.reload();
            }
        );
    }
    //栏目形象图
    $(".class_pic").powerFloat({
        targetMode: "ajax"
    });
    //删除
    function del(aid, obj, url) {
        var obj;
        ajaxpost(
            '确认要删除本内容吗?删除无法恢复！',
            url,
            {aid: aid},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
</script>

