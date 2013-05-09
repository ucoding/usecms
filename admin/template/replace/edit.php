<div class="page_function">
    <div class="info">
        <h3>内容替换修改</h3>
        <small>使用以下功能进行内容替换修改操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">编辑内容替换</a>
    <!--<a  href="javascript:menuload('__URL__')">返回内容替换列表</a>-->
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">被替换内容</td>
                    <td width="300">
                        <input name="key" type="text" class="text_value" id="key" value="{$info.key}" reg="\S"
                               msg="内容替换名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">替换后内容</td>
                    <td>
                        <input name="content" type="text" class="text_value" id="content" reg="\S" msg="替换后内容不能为空"
                               value="{$info.content}"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">替换次数</td>
                    <td>
                        <input name="num" type="text" class="text_value" id="num" value="{$info.num}" reg="[0-9]"
                               msg="替换次数只能为数字"/>
                    </td>
                    <td></td>
                </tr>

            </table>
        </div>
        <!--普通提交-->
        <div class="form_submit">
            <input name="id" type="hidden" value="{$info.id}"/>
            <input name="file_id" id="file_id" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__URL__");
</script>