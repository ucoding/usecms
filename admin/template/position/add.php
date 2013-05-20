<div class="page_function">
    <div class="info">
        <h3>推荐位添加</h3>

    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">添加推荐位</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">推荐位名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">推荐位顺序</td>
                    <td>
                        <input name="sequence" type="text" class="text_value" id="sequence" value="0" reg="^[0-9]*$"
                               msg="只能是数字"/>
                    </td>
                    <td>针对后台的显示顺序(顺序排列)</td>
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