<div class="page_function">
    <div class="info">
        <h3>添加栏目</h3>
        <small>使用以下功能进行栏目添加操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">添加栏目</a>
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
                            <@foreach:{$category_list $vo}>
                            <option value="{$vo.cid}">{$vo.cname}</option>
                            <@/foreach>
                        </select>
                        &nbsp;&nbsp;<a href="javascript:;" onclick="advanced()">高级设置</a>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目名称</td>
                    <td>
                        <textarea name="namelist" class="text_textarea" id="namelist" reg="\S"
                                  msg="栏目名称不能为空"></textarea>
                    </td>
                    <td>批量添加一行一个栏目名</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">副栏目名称</td>
                    <td>
                        <input name="subname" type="text" class="text_value" id="subname" value=""/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目缩略图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image') ?>
                        <input name="image" type="text" class="text_value" id="image" style="width:200px; float:left"
                               value=""/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>
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
                    <td colspan="2">
                        <textarea name="description" class="text_textarea" id="description"></textarea>
                    </td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">SEO内容</td>
                    <td><textarea name="seo_content" class="text_textarea" id="seo_content"></textarea>
                    </td>
                    <td>可以填写HTML代码</td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目属性</td>
                    <td>
                        <input name="type" type="radio" value="0"/>
                        频道页
                        &nbsp;&nbsp;
                        <input name="type" type="radio" value="1" checked="checked"/>
                        列表页
                    </td>
                    <td>频道页无法发布内容，列表页可以发布内容</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">栏目显示</td>
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
                    <td width="100" align="right">内容分页数</td>
                    <td width="300">
                        <input name="page" type="text" class="text_value" id="page" value="15"/>
                    </td>
                    <td>栏目下内容每页多少条</td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目顺序</td>
                    <td>
                        <input name="sequence" type="text" class="text_value" id="sequence" value="0"/>
                    </td>
                    <td>数字越大越在前面</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">内容排序</td>
                    <td>
                        <select name="content_order">
                            <option value="updatetime DESC">内容更新时间 新-旧</option>
                            <option value="updatetime ASC">内容更新时间 旧-新</option>
                            <option value="inputtime DESC">内容发布时间 新-旧</option>
                            <option value="inputtime ASC">内容发布时间 旧-新</option>
                            <option value="order DESC">内容自定义排序 大-小</option>
                            <option value="order ASC">内容自定义排序 小-大</option>
                        </select>
                    </td>
                    <td>针对该栏目下内容的排序方式</td>
                </tr>
                <?php module('common')->plus_hook('category', 'add_tpl'); ?>
                <tr>
                    <td width="100" align="right">栏目模板</td>
                    <td>
                        <input name="class_tpl" type="text" class="text_value" id="class_tpl" value="list.php"/>
                    </td>
                    <td>用于频道或列表的显示</td>
                </tr>
                <tr>
                    <td width="100" align="right">内容模板</td>
                    <td>
                        <input name="content_tpl" type="text" class="text_value" id="content_tpl" value="content.php"/>
                    </td>
                    <td>用于该栏目下的内容显示</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">扩展模型</td>
                    <td width="300">
                        <select name="expand" id="expand">
                            <option value="0">无</option>
                            <@foreach:{$model_list $vo}>
                            <option value="{$vo.mid}">{$vo.name}</option>
                            <@/foreach>
                        </select>
                    </td>
                    <td>用于附加内容字段</td>
                </tr>
            </table>
        </div>
        <div class="form_submit">
            <input name="file_id" id="file_id" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__APP__/category");

    //高级模式
    function advanced() {
        $('.advanced').toggle();
    }
    function tpl_list(id) {
        var list = [
            <@foreach:{$tpl_list $vo}>
            {
                href: "javascript:;\" onclick=\"tpl_val('" + id + "','{$vo}');\"",
                text: "{$vo}"
            },
            <@/foreach>
            {
                text: "请选择模板"
            }
        ];
        return list;

    }

    //模板列表
    function tpl_list(id) {
        var list = [
            <@foreach:{$tpl_list $vo}>
            {
                href: "javascript:;\" onclick=\"tpl_val('" + id + "','{$vo}');\"",
                text: "{$vo}"
            },
            <@/foreach>
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
        $("#content_tpl").powerFloat({
            width: 250,
            eventType: "click",
            target: tpl_list('content_tpl'),
            targetMode: "list"
        });
    });

</script>