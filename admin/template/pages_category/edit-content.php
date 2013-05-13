<div class="page_function">
    <div class="info">
        <h3>页面编辑</h3>
        <small>使用以下功能进行页面编辑操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#tab1">基本属性</a>
    <a href="#tab2">高级设置</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">上级栏目</td>
                    <td width="300">
                        <select name="pid" id="pid">
                            <option value="0">=====顶级栏目=====</option>
                            <@foreach:{$category_list $vo}>
                            <option
                            <@if:{$vo['cid']==$info['pid']}>selected="selected"<@/if>
                            value="{$vo.cid}">{$vo.cname}</option>
                            <@/foreach>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">页面名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="{$info.name}" reg="\S"
                               msg="页面名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">页面缩略图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image', false, 'editor_content') ?>
                        <input name="image" type="text" class="text_value" id="image" style="width:205px; float:left"
                               value="{$info.image}"/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">内容</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_editor('content'); ?>
                        <textarea name="content" style="width:100%; height:350px;" id="content">{$page_info.content
                            html}</textarea>
                        <input type="button" onclick="javascript:get_remote_image()" style="margin-top:10px;"
                               class="button_small" value="远程图片本地化"/>

                        <?php module('common')->plus_hook('content', 'tools', $info); ?>

                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">附件上传</td>
                    <td colspan="2">
                        <?php echo module('editor')->sapload('editor_content'); ?>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目顺序</td>
                    <td width="300">
                        <input name="sequence" type="text" class="text_value" id="sequence" value="{$info.sequence}"/>
                    </td>
                    <td>数字越大越在前面</td>
                </tr>
                <?php module('common')->plus_hook('category', 'edit_tpl'); ?>

            </table>
        </div>

        <div class="page_table form_table" id="tab2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">页面URL名称</td>
                    <td width="300">
                        <input name="urlname" type="text" class="text_value" id="urlname" value="{$info.urlname}"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO关键词</td>
                    <td width="300">
                        <input name="keywords" type="text" class="text_value" id="keywords" value="{$info.keywords}"/>
                    </td>
                    <td>以,号分割</td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO描述</td>
                    <td width="300"><textarea name="description" class="text_textarea" id="description">{$info.description}</textarea>
                    </td>
                    <td>对本页面的简单介绍</td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO内容</td>
                    <td><textarea name="seo_content" class="text_textarea" id="seo_content">{$info.seo_content
                            html}</textarea>
                    </td>
                    <td>可以填写HTML代码</td>
                </tr>
                <tr>
                    <td width="100" align="right">页面显示</td>
                    <td width="300">
                        <input name="show" type="radio" value="1" <@if:{$info['show']==1}>checked="checked"
                        <@/if> />
                        显示
                        &nbsp;&nbsp;
                        <input name="show" type="radio" value="0" <@if:{$info['show']==0}>checked="checked"
                        <@/if> />
                        隐藏
                    </td>
                    <td>控制页面调用的显示与隐藏</td>
                </tr>
            </table>
        </div>
        <div class="form_submit">
            <input name="cid" type="hidden" value="{$info.cid}"/>
            <input name="file_id" id="file_id" type="hidden" value="{$file_id}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
<script type="text/javascript">
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

    saveform(function (msg) {
        $.dialog.tips(msg, 3);
    }, function (msg) {
        $.dialog.tips(msg, 3);
    });

    //页面执行
    $(function () {

        $("#tab").idTabs();
    });

</script>