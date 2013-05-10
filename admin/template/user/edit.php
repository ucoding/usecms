<div class="page_function">
    <div class="info">
        <h3>管理员编辑</h3>
        <small>使用以下功能进行管理员编辑操作</small>
    </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#">编辑管理员</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">角色</td>
                    <td width="300"><select name="gid" id="gid">
                            <@foreach:{$user_group $vo}>
                            <option value="{$vo.id}">{$vo.name}</option>
                            <@/foreach>
                        </select></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">帐号</td>
                    <td width="300"><input name="user" type="text" class="text_value" id="user" value="{$info.user}"
                                           reg="\S" msg="管理员帐号不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">昵称</td>
                    <td width="300"><input name="nicename" type="text" class="text_value" id="nicename"
                                           value="{$info.nicename}" reg="\S" msg="管理员昵称不能为空"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">密码</td>
                    <td width="300"><input name="password" type="password" class="text_value" id="password"/></td>
                    <td>不修改密码请勿填写！</td>
                </tr>
                <tr>
                    <td width="100" align="right">确认密码</td>
                    <td width="300"><input name="password2" type="password" class="text_value" id="password2"/></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">状态</td>
                    <td width="300"><input name="status" type="radio" value="1" <@if:{$info['status']==1}>
                        checked="checked" <@/if> />
                        正常&nbsp;&nbsp;
                        <input name="status" type="radio" value="0" <@if:{$info['status']==0}> checked="checked"
                        <@/if> />
                        禁用
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