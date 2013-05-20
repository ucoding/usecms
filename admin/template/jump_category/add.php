<div class="page_function">
    <div class="info">
        <h3>跳转页面添加</h3>

    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">添加跳转页面</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">跳转页面名称</td>
                    <td>
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="跳转页面名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">跳转页面URL名称</td>
                    <td>
                        <input name="urlname" type="text" class="text_value" id="urlname" value=""/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">跳转页面缩略图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image') ?>
                        <input name="image" type="text" class="text_value" id="image" style="width:200px; float:left"
                               value=""/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">跳转到</td>
                    <td>
                        <input name="url" type="text" class="text_value" id="url"/>
                    </td>
                    <td>URL链接，支持标签</td>
                </tr>
                <tr class="advanced">
                    <td width="100" align="right">跳转页面显示</td>
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
</script>