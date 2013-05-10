<link href="__PUBLICURL__/ztree/css/zTreeStyle.css" rel="stylesheet" type="text/css"/>
<script src="__PUBLICURL__/ztree/jquery.ztree.js"></script>
<script src="__PUBLICURL__/ztree/jquery.ztree.exhide.js"></script>
<script src="__PUBLICURL__/ztree/jquery.ztree.excheck.js"></script>
<script>
    var zTree;
    var setting = {
        view: {
            nameIsHTML: true
        },
        check: {
            enable: true
        },
        data: {
            key: {
                title: "title"
            },
            simpleData: {
                enable: true,
                idKey: "cid",
                pIdKey: "pid",
                rootPId: ""
            }
        }
    };
    var zNodes = [
        <?php echo $class_tree; ?>
    ];
    $(document).ready(function () {
        var t = $("#tree");
        t = $.fn.zTree.init(t, setting, zNodes);
        t.expandAll(true);
    });
</script>
<div class="page_function">
    <div class="info">
        <h3>角色添加</h3>
        <small>使用以下功能进行角色添加操作</small>
    </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#">添加角色</a>
</div>
<div class="page_form">
    <form action="__URL__/add_save/time-<?php echo time() ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">角色名称</td>
                    <td width="300"><input name="name" type="text" class="text_value" id="name" value="" reg="\S"
                                           msg="角色名称不能为空"/></td>
                    <td></td>
                </tr>
                <@if:{$user['grade']==1}>
                <tr>
                    <td width="100" align="right">管理等级</td>
                    <td width="300">
                        <select name="grade" id="grade">
                            <option value="1">一级角色</option>
                            <option value="2">二级角色</option>
                            <option value="3">三级角色</option>
                        </select>
                    </td>
                    <td>低级别将看不到高级别的角色与所属用户(只有级别等于一级的用户才可设置级别，默认三级用户)</td>
                </tr>
                <@{/if}>
                <tr>
                    <td width="100" align="right">内容与栏目权限
                        <br/>
                        <font color="#ccc">设置上级栏目的权限会影响到下级栏目的权限</font>
                    </td>
                    <td colspan="2">
                        <ul id="tree" class="ztree">
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">内容权限</td>
                    <td colspan="2">
                        <fieldset class="source">
                            <legend>内容审核状态</legend>
                            可管理状态 <input name="status_power" type="radio" value="0" checked="checked"/>
                            &nbsp;&nbsp;默认通过 <input name="status_power" value="1" type="radio"/>
                            &nbsp;&nbsp;默认草稿 <input name="status_power" value="2" type="radio"/>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">模块插件权限</td>
                    <td colspan="2">
                        <@foreach:{$menu_list $vo}>
                        <fieldset class="source">
                            <legend>{$vo['name']}</legend>
                            <?php $list = model('menu')->menu_list($vo['id']);
                            if (!empty($list)) foreach ($list as $val) { ?>
                                <input name="model_power[]" type="checkbox" value="{$val['id']}">
                                {$val['name']} &nbsp;&nbsp;
                            <?php } ?>
                        </fieldset>
                        <@{/foreach}>

                    </td>
                </tr>
            </table>
        </div>

        <div class="form_submit">
            <input name="class_power" id="class_power" type="hidden" value=""/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__URL__",
        function () {
            var zTree = $.fn.zTree.getZTreeObj("tree");
            zTree.expandAll(true);
            var nodes = zTree.getCheckedNodes(true);
            var purview = "";
            for (var i = 0; i < nodes.length; i++) {
                purview += nodes[i].cid + ",";
            }
            $('#class_power').val(purview);
        }
    );
</script>