<div class="page_function">
    <div class="info">
        <h3>推荐位修改</h3>
        <small>使用以下功能进行推荐位添加操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">修改推荐位</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">推荐位名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="{$info.name}" reg="\S"
                               msg="名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">推荐位顺序</td>
                    <td>
                        <input name="sequence" type="text" class="text_value" id="sequence" value="{$info.sequence}"
                               reg="^[0-9]*$" msg="只能是数字"/>
                    </td>
                    <td>针对后台的显示顺序(顺序排列)</td>
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