<div class="page_function">
    <div class="info">
        <h3>语言添加</h3>
        <small>使用以下功能进行语言添加操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">添加语言</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">语言名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="语言名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">语言标识</td>
                    <td>
                        <input name="lang" type="text" class="text_value" id="lang" reg="\S" msg="语言标识不能为空"/>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__URL__");
</script>