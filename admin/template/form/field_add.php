<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {$css}
    {$js}
</head>
<body scroll="no">
<div class="page_function">
    <div class="info">
        <h3>字段添加</h3>
        <small>使用以下功能进行字段操作</small>
    </div>
</div>
<div class="page_form">
    <form autocomplete="off" action="__URL__/field_add_save/time-<?php echo time(); ?>-ajax-true" method="post"
          id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">字段类型</td>
                    <td width="350">
                        <select name="type" id="type" onchange="fildtype($(this).val())">
                            <!--foreach:{$field_type $key $vo}-->
                            <option value="{$key}">{$vo.name}</option>
                            <!--{/foreach}-->
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">字段属性</td>
                    <td>
                        <select name="property" id="property">
                            <!--foreach:{$field_property $key $vo}-->
                            <option value="{$key}">{$vo.name}</option>
                            <!--{/foreach}-->
                        </select>
                        &nbsp;&nbsp;长度 <input name="len" type="text" class="text_value" id="len" value="250" reg="[0-9]"
                                              style="width:45px;"/>
                        &nbsp;&nbsp;小数 <input name="decimal" type="text" class="text_value" id="decimal" value="0"
                                              reg="[0-9]" style="width:45px;"/>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">字段描述</td>
                    <td>
                        <input name="name" type="text" class="text_value" id="name" style="width:100px;" value=""
                               reg="\S" msg="字段描述不能为空"/>
                        &nbsp;&nbsp;字段名
                        <input name="field" type="text" class="text_value" id="field" style="width:100px;" value=""
                               reg="[a-zA-Z_]" msg="字段名只能为英文和下划线"/>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">字段提示</td>
                    <td>
                        <input name="tip" type="text" class="text_value" id="tip" value="" style="width:150px;"/>
                        &nbsp;&nbsp;字段顺序
                        &nbsp;<input name="sequence" type="text" class="text_value" id="sequence" style="width:30px;"
                                     reg="[0-9]" value="0"/>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">是否必填</td>
                    <td>
                        <input name="must" type="radio" value="1"/>
                        是
                        &nbsp;&nbsp;
                        <input name="must" type="radio" value="0" checked="checked"/>
                        否
                        &nbsp;&nbsp;&nbsp;后台列表显示&nbsp;&nbsp;
                        <input name="admin_display" type="radio" value="1"/>
                        是
                        &nbsp;&nbsp;
                        <input name="admin_display" type="radio" value="0" checked="checked"/>
                        否
                    </td>
                </tr>

                <tr>
                    <td width="120" align="right">默认内容</td>
                    <td><input name="default" type="text" class="text_value" id="default" value=""/>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">字段配置</td>
                    <td><textarea name="config" class="text_textarea" id="config"></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="120" align="right">后台列表显示</td>
                    <td><textarea name="admin_html" class="text_textarea" id="admin_html"></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <!--普通提交-->
        <div class="form_submit">
            <input name="fid" type="hidden" value="{$info.id}">
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    var api = frameElement.api;
    saveform(
        function () {
            api.reload();
            api.close();
        },
        function (msg) {
            $.dialog.tips(msg, 3).zindex(2000);
        }
    );
    //获取最佳设置
    function fildtype(type) {
        type = parseInt(type);
        switch (type) {
            case 1:
            case 4:
            case 10:
            case 7:
            case 9:
                $('#property').val(1);
                $('#len').val(250);
                $('#decimal').val(0);
                break;
            case 6:
            case 8:
                $('#property').val(2);
                $('#len').val(10);
                $('#decimal').val(0);
                break;
            case 2:
            case 3:
            case 5:
                $('#property').val(3);
                $('#len').val(0);
                $('#decimal').val(0);
                break;
        }
    }
</script>
</body>