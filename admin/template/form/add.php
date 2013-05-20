<div class="page_function">
    <div class="info">
        <h3>表单添加</h3>

    </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#">添加表单</a> <a href="javascript:menuload('__URL__')">返回表单列表</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                    <td width="100" align="right">表单名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="" reg="\S" msg="表单名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">表单名</td>
                    <td>
                        <input name="table" type="text" class="text_value" id="table" reg="[a-zA-Z0-9_]"
                               msg="表单名只能为英文数字和下划线"/>
                    </td>
                    <td>数据表名</td>
                </tr>

                <tr>
                    <td width="100" align="right">前台表单</td>
                    <td>
                        <input name="display" type="radio" value="1"/>
                        是
                        &nbsp;&nbsp;
                        <input name="display" type="radio" value="0" checked="checked"/>
                        否
                    </td>
                    <td>是否在前台显示此表单</td>
                </tr>


                <tr>
                    <td width="100" align="right">前台分页数</td>
                    <td>
                        <input name="page" type="text" class="text_value" id="page" value="10" reg="[0-9]"
                               msg="分页数只能为数字"/>
                    </td>
                    <td>前台列表显示的分页数</td>
                </tr>

                <tr>
                    <td width="100" align="right">内容排序</td>
                    <td>
                        <input name="order" type="text" class="text_value" id="order" value="id desc" reg="\S"/>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td width="100" align="right">前台列表条件</td>
                    <td>
                        <input name="where" type="text" class="text_value" id="where" value=""/>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td width="100" align="right">独立模板</td>
                    <td>
                        <input name="alone_tpl" type="radio" value="1"/>
                        是
                        &nbsp;&nbsp;
                        <input name="alone_tpl" type="radio" value="0" checked="checked"/>
                        否
                    </td>
                    <td>否的话外部调用公共模板(common.php)</td>
                </tr>

                <tr>
                    <td width="100" align="right">前台模板名称</td>
                    <td>
                        <input name="tpl" type="text" class="text_value" id="tpl"/>
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