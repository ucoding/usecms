<div class="page_function">
    <div class="info">
        <h3>页面添加</h3>
        <small>页面主要用于公司简介等单个页面展示</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">添加栏目</a>
    <!--<a  href="javascript:menuload('__APP__/category')">返回栏目列表</a>-->
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">上级栏目</td>
                    <td width="300">
                        <select name="pid" id="pid">
                            <option value="0">=====顶级栏目=====</option>
                            <!--foreach:{$category_list $vo}-->
                            <option value="{$vo.cid}">{$vo.cname}</option>
                            <!--{/foreach}-->
                        </select>
                        &nbsp;&nbsp;<a href="javascript:;" onclick="advanced()">高级设置</a>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">页面名称</td>
                    <td>
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="页面名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">副名称</td>
                    <td>
                        <input name="subname" type="text" class="text_value" id="subname" value=""/>
                    </td>
                    <td></td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">页面URL名称</td>
                    <td>
                        <input name="urlname" type="text" class="text_value" id="urlname" value=""/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">页面形象图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image', false, 'editor_content') ?>
                        <input name="image" type="text" class="text_value" id="image" style="width:220px; value=""/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>
                    </td>
                </tr>

                <tr>
                    <td width="100" align="right">内容</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_editor('content'); ?>
                        <textarea name="content" style="width:100%; height:350px;" id="content"></textarea>
                        <input type="button" onclick="javascript:get_remote_image()" style="margin-top:10px;"
                               class="button_small" value="远程图片本地化"/>
                        <!--hook-->
                        <?php module('common')->plus_hook('content', 'tools'); ?>
                        <!--hook end-->
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">附件上传</td>
                    <td colspan="2">
                        <?php echo module('editor')->sapload('editor_content'); ?>
                    </td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">关键词</td>
                    <td>
                        <input name="keywords" type="text" class="text_value" id="keywords"/>
                    </td>
                    <td>以,号分割</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">描述</td>
                    <td><textarea name="description" class="text_textarea" id="description"></textarea>
                    </td>
                    <td>对本页面的简单介绍</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">SEO内容</td>
                    <td><textarea name="seo_content" class="text_textarea" id="seo_content"></textarea>
                    </td>
                    <td>可以填写HTML代码</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">页面显示</td>
                    <td>
                        <input name="show" type="radio" value="1" checked="checked"/>
                        显示
                        &nbsp;&nbsp;
                        <input name="show" type="radio" value="0"/>
                        隐藏
                    </td>
                    <td>控制栏目调用的显示与隐藏</td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目顺序</td>
                    <td>
                        <input name="sequence" type="text" class="text_value" id="sequence" value="0"/>
                    </td>
                    <td>数字越大越在前面</td>
                </tr>

                <!--hook-->
                <?php module('common')->plus_hook('category', 'add_tpl'); ?>
                <!--hook end-->

                <tr>
                    <td width="100" align="right">页面模板</td>
                    <td>
                        <input name="class_tpl" type="text" class="text_value" id="class_tpl" value="page.php"/>
                    </td>
                    <td>用于页面的显示</td>
                </tr>

            </table>
        </div>
        <!--普通提交-->
        <div class="form_submit">
            <input name="file_id" id="file_id" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //远程抓图
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
    //提交表单
    savelistform("__URL__/add", "__APP__/category");
    //高级模式
    function advanced() {
        $('.advanced').toggle();
    }
    //模板列表
    function tpl_list(id) {
        var list = [
            <!--foreach:{$tpl_list $vo}-->
            {
                href: "javascript:;\" onclick=\"tpl_val('" + id + "','{$vo}');\"",
                text: "{$vo}"
            },
            <!--{/foreach}-->
            {
                text: "请选择模板"
            }
        ];
        return list;

    }
    //模板赋值
    function tpl_val(id, val) {
        $('#' + id).val(val);
        $('#floatBox_list').hide();
        return false;
    }

    //页面执行
    $(document).ready(function () {
        //模板选择
        $("#class_tpl").powerFloat({
            width: 250,
            eventType: "click",
            target: tpl_list('class_tpl'),
            targetMode: "list"
        });
    });
</script>