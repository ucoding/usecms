<div class="page_function">
    <div class="info">
        <h3>自定义变量管理</h3>

    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">编辑变量</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">描述</td>
                    <td width="300">
                        <input name="title" type="text" class="text_value" id="title" value="{$info.title}" reg="\S"
                               msg="描述不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">标识</td>
                    <td>
                        <input name="sign" type="text" class="text_value" id="sign" reg="[a-zA-Z_]" msg="标识只能为英文和下划线"
                               value="{$info.sign}"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">内容</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_editor('content'); ?>
                        <textarea name="content" style="width:100%; height:350px;" id="content">{$info.content
                            html}</textarea>

                    </td>
                </tr>

            </table>
        </div>

        <div class="form_submit">
            <input name="id" type="hidden" value="{$info.id}"/>
            <input name="file_id" id="file_id" type="hidden" value="{$file_id}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__URL__");
</script>