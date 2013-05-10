<div class="page_function">
    <div class="info">
        <h3>管理员添加</h3>
        <small>使用以下功能进行管理员添加操作</small>
    </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#">添加管理员</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">角色</td>
                    <td width="300">
                        <select name="gid" id="gid">
                            <@foreach:{$user_group $vo}>
                            <option value="{$vo.id}">{$vo.name}</option>
                            <@{/foreach}>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">帐号</td>
                    <td width="300"><input name="user" type="text" class="text_value" id="user" value="" reg="\S"
                                           msg="管理员帐号不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">昵称</td>
                    <td width="300"><input name="nicename" type="text" class="text_value" id="nicename" value=""
                                           reg="\S" msg="管理员昵称不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">密码</td>
                    <td width="300"><input name="password" type="password" class="text_value" id="password" value=""
                                           reg="\S" msg="密码不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">确认密码</td>
                    <td width="300"><input name="password2" type="password" class="text_value" id="password2" value=""
                                           reg="\S" msg="确认密码不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">状态</td>
                    <td width="300">
                        <input name="status" type="radio" value="1" checked="checked"/>正常&nbsp;&nbsp;
                        <input name="status" type="radio" value="0"/>禁用
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