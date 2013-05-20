<div class="page_function">
    <div class="info">
        <h3>{$info.name}添加</h3>
    </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#">添加{$info.name}</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right" width="100">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <@foreach:{$field_list $vo}>
                {$php( echo model('expand_model')->get_field_html($vo))}
                <@/foreach>

            </table>
        </div>

        <div class="form_submit">
            <input name="fid" type="hidden" value="{$info.id}"/>
            <input name="file_id" id="file_id" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add/id-{$info.id}", "__URL__/index/id-{$info.id}");
</script>