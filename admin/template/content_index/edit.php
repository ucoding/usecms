<style>
    html, body {
        overflow: hidden;
    }
</style>
<div class="page_function">
    <div class="info">
        <h3>快速编辑</h3>
        <small>快速编辑一些常用内容</small>
    </div>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form" autocomplete="off">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">栏目</td>
                    <td width="350"><select name="cid" reg="." id="cid" onChange="get_fields(1)">
                            <option value="">======选择栏目======</option>
                            <!--foreach:{$category_list $vo}-->
                            <option
                                value="{$vo['cid']}" <?php if ($info['cid'] == $vo['cid']) { ?> selected="selected" <?php } ?>
                                <?php if ($vo['type'] == 0 || $vo['mid'] <> $model_info['mid']){ ?>style="background-color:#ccc" disabled="disabled" <?php } ?>
                                <?php if (!empty($user['class_power'])) {
                                    if (!in_array($vo['cid'], explode(',', $user['class_power']))) { ?> style="background-color:#ccc"  disabled="disabled" <?php }
                                } ?> >
                                {$vo['cname']}
                            </option>
                            <!--{/foreach}-->
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">标题</td>
                    <td colspan="2"><input name="title" type="text" class="text_value" id="title" value="{$info.title}"
                                           reg="\S" msg="标题不能为空"/></td>
                </tr>
                <tr>
                    <td width="100" align="right">广告位</td>
                    <td width="350">
                        <!--foreach:{$position_list $vo}-->
                        <input name="position[]" type="checkbox" value="{$vo.id}" <?php if (is_array($position_array)) {
                            if (in_array($vo['id'], $position_array)) { ?> checked="checked" <?php }
                        } ?> /> {$vo.name}&nbsp;&nbsp;
                        <!--{/foreach}-->
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">英文URL名称</td>
                    <td width="350"><input name="urltitle" type="text" class="text_value" id="urltitle"
                                           value="{$info.urltitle}"/></td>
                    <td></td>
                </tr>
                <tr>
                <tr>
                    <td width="100" align="right">描述</td>
                    <td colspan="2"><textarea name="description" class="text_textarea" id="description">{$info.description}</textarea>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">关键词</td>
                    <td colspan="2"><input name="keywords" type="text" class="text_value" id="keywords"
                                           value="{$info.keywords}"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">更新时间</td>
                    <td width="350">
                        <input name="updatetime" id="updatetime" type="text" class="text_value"
                               style="width:260px; float:left"
                               value="<?php echo date('Y-m-d H:i:s', $info['updatetime']) ?>" reg="\S" msg="更新时间不能为空"/>

                        <div id="updatetime_button" class="time"></div>
                        <script>$('#updatetime_button').calendar({ id: '#updatetime', format: 'yyyy-MM-dd HH:mm:ss'});</script>
                    </td>
                    <td></td>
                </tr>
                <tbody id="expand">
                </tbody>
                <!--hook-->
                <?php module('common')->plus_hook('content', 'edit_tpl', $info); ?>
                <!--hook end-->
                <?php if ($user['status_power'] <> 2 || $user['keep'] == 1) { ?>
                    <tr>
                        <td width="100" align="right">状态</td>
                        <td width="350">
                            <input name="status" type="radio" value="1" checked="checked"/> 发布&nbsp;&nbsp;<input
                                name="status" type="radio" value="0"/> 草稿&nbsp;&nbsp;
                        </td>
                        <td></td>
                    </tr>
                <?php } else { ?>
                    <input name="status" id="status" type="hidden" value="0"/>
                <?php } ?>


            </table>
        </div>
        <!--普通提交-->
        <div class="form_submit">
            <input name="aid" type="hidden" value="{$info.aid}"/>
            <input name="file_id" id="file_id" type="hidden" value="{$file_id}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //TAG
    $('#keywords').tagsInput(
        {
            'defaultText': '关键词会转为tag'
        });
    var api = frameElement.api;
    //提交表单
    saveform(function (msg) {
        api.reload();
        api.close();
    });

</script>