<div class="page_function">
    <div class="info">
        <h3>{$model_info.name}添加</h3>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#tab1">基本属性</a>
    <a href="#tab2">高级设置</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form" autocomplete="off">
        <div class="page_table form_table" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">标题</td>
                    <td colspan="2"><input name="title" type="text" class="text_value" id="title"
                                           style="float:left; width:360px;" value="" reg="\S" msg="标题不能为空"/>
                </tr>
                <tr>
                    <td width="100" align="right">推荐位</td>
                    <td width="350">
                        <@foreach:{$position_list $vo}>
                        <input name="position[]" type="checkbox" value="{$vo.id}"/> {$vo.name}&nbsp;&nbsp;
                        <@/foreach>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">内容缩略图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image', false, 'editor_content') ?>
                        <input name="image" type="text" class="text_value" id="image" value="" style="width:220px"/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>
                        <input type="button" class="button_small" onclick="get_one_pic()" value="提取第一张图"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">内容</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_editor('content'); ?>
                        <textarea name="content" style="width:100%; height:350px;" id="content"></textarea>
                        <input type="button" onclick="javascript:get_remote_image()" style="margin-top:10px;"
                               class="button_small" value="远程图片本地化"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">附件上传</td>
                    <td colspan="2">
                        <?php echo module('editor')->sapload('editor_content'); ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">内容来源</td>
                    <td width="350"><input name="copyfrom" type="text" class="text_value" id="copyfrom"
                                           value="<?php echo $befrom_list[0] ?>"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO描述</td>
                    <td colspan="2"><textarea name="description" class="text_textarea" id="description"></textarea>
                        &nbsp;&nbsp;<input type="button" id="" onclick="javascript:get_description()"
                                           class="button_small" value="提取描述"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO关键词</td>
                    <td colspan="2"><input name="keywords" type="text" class="text_value" id="keywords" value=""/>
                        &nbsp;&nbsp;<input type="button" id="" onclick="javascript:get_keywords()" class="button_small"
                                           value="提取关键词"/>
                        &nbsp;&nbsp;<input name="taglink" type="checkbox" value="1"/> 内容自动链接
                    </td>
                </tr>
                <tbody id="expand">
                </tbody>

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
        <div class="page_table form_table" id="tab2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">英文URL名称</td>
                    <td width="350"><input name="urltitle" type="text" class="text_value" id="urltitle" value=""/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">访问量</td>
                    <td width="350">
                        <input name="views" type="text" class="text_value" id="views" value=""/>
                    </td>
                    <td>内容浏览量</td>
                </tr>
                <tr>
                    <td width="100" align="right">顺序</td>
                    <td width="350">
                        <input name="sequence" type="text" class="text_value" id="sequence" value=""/>
                    </td>
                    <td>(自定义顺序)</td>
                </tr>
                <tr>
                    <td width="100" align="right">更新时间</td>
                    <td width="350">
                        <input name="updatetime" id="updatetime" type="text" class="text_value"
                               style="width:260px; float:left" value="<?php echo date('Y-m-d H:i:s') ?>" reg="\S"
                               msg="更新时间不能为空"/>

                        <div id="updatetime_button" class="time"></div>
                        <script>$('#updatetime_button').calendar({ id: '#updatetime', format: 'yyyy-MM-dd HH:mm:ss'});</script>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目</td>
                    <td width="350"><select name="cid" reg="." id="cid" onChange="get_fields()">
                            <option value="">======选择栏目======</option>
                            <@foreach:{$category_list $vo}>
                            <option
                                value="{$vo['cid']}" <?php if ($class_info['cid'] == $vo['cid']) { ?> selected="selected" <?php } ?>
                                <?php if ($vo['type'] == 0 || $vo['mid'] <> $model_info['mid']){ ?>style="background-color:#ccc" disabled="disabled" <?php } ?>
                                <?php if (!empty($user['class_power'])) {
                                    if (!in_array($vo['cid'], explode(',', $user['class_power']))) {
                                        ?> style="background-color:#ccc"  disabled="disabled" <?php
                                    }
                                } ?> >
                                {$vo['cname']}
                            </option>
                            <@/foreach>
                        </select>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="form_submit">
            <input name="inputtime" type="hidden" value="{$php(echo time())}"/>
            <input name="file_id" id="file_id" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {

        //tab菜单
        $("#tab").idTabs();
        get_fields();
    });
    //TAG
    $('#keywords').tagsInput(
        {
            'defaultText': '关键词会转为tag'
        });

    //高级模式
    function advanced() {
        $('.advanced').toggle();
    }
    //提取第一张图片
    function get_one_pic() {
        var content = editor_content.html();
        var imgreg = /<img.*?(?:>|\/>)/gi;
        var srcreg = /src=[\'\"]?([^\'\"]*)[\'\"]?/i;
        var arr = content.match(imgreg);
        var src = arr[0].match(srcreg);
        $("#image").val(src[1]);
    }
    //提取描述
    function get_description() {
        var content = editor_content.text();
        content = content.substring(0, 500);
        content = content.replace(/\s+/g, "")
        content = content.replace(/[\r\n]/g, " ");
        content = content.replace(/<\/?[^>]*>/g, '');
        if (content.length > 250) {
            content = content.substring(0, 250);
        }
        $("#description").val(content);
    }
    function get_keywords() {
        ajaxpost_w(
            '__URL__/get_keyword',
            {title: $('#title').val(), content: $('#description').val()},
            2,
            function (msg) {
                $('#keywords').importTags(msg);
            },
            function () {
            },
            '关键词获取完毕'
        );
    }

    function get_remote_image() {
        ajaxpost_w(
            '__APP__/editor/get_remote_image',
            {content: editor_content.html()},
            2,
            function (msg) {
                editor_content.html(msg);
            },
            function () {
            },
            '远程抓图执行完毕'
        );
    }

    function fontbold() {
        if ($('#font_bold').val() == 0) {
            $('#title').css("font-weight", 'bold');
            $('#font_bold').val(1);
        } else {
            $('#title').css("font-weight", 'normal');
            $('#font_bold').val(0);
        }
    }
    //获取附加字段
    function get_fields() {
        var cid = $('#cid').val();
        $.ajax({
            type: 'POST',
            url: "__APP__/expand_model/get_field",
            data: {
                cid: cid
            },
            dataType: "html",
            success: function (data) {
                $('#expand').html(data);
            }
        })
    }

    //提交表单
    savelistform("__URL__/add/cid-{$class_info.cid}", "javascript:history.go(-1)");

</script>