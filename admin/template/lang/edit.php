<div class="page_function">
    <div class="info">
        <h3>语言修改</h3>

    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">编辑语言</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">语言名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="{$info.name}" reg="\S"
                               msg="语言名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">语言标识</td>
                    <td>
                        <input name="lang" type="text" class="text_value" id="lang" value="{$info.lang}"
                               readonly="readonly" reg="\S" msg="语言标识不能为空"/>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
            <input name="id" type="hidden" value="{$info.id}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__URL__");
</script>