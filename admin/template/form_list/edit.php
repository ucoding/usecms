<div class="page_function">
    <div class="info">
        <h3>{$info.name}编辑</h3>
        <small>使用以下功能进{$info.name}修改操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#">修改{$info.name}</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
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
                {$php( echo model('expand_model')->get_field_html($vo,$info[$vo['field']]))}
                <@/foreach>

            </table>
        </div>

        <div class="form_submit">
            <input name="id" type="hidden" value="{$info.id}"/>
            <input name="fid" type="hidden" value="{$form_info.id}"/>
            <input name="file_id" id="file_id" type="hidden" value="{$file_id}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add/id-{$form_info.id}", "__URL__/index/id-{$form_info.id}");
</script>