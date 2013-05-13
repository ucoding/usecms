<div class="page_function">
    <div class="info">
        <h3>栏目管理</h3>
        <small>使用以下功能进行栏目添加操作</small>
    </div>
    <div class="exercise">
        <@foreach:{$model_list $vo}>
        <a href="javascript:menuload('__APP__/{$vo.model}_category/add')">添加{$vo.name}</a>
        <@/foreach>
    </div>
</div>
<div class="page_main">
    <div class="page_table table_list">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="25%">栏目名称</th>
                <th width="10%">
                    <center>顺序</center>
                </th>
                <th width="10%">
                    <center>栏目显示</center>
                </th>
                <th width="15%">
                    <center>栏目属性</center>
                </th>
                <th width="15%">
                    <center>栏目操作</center>
                </th>
            </tr>
            <@foreach:{$list $vo}>
            <tr>
                <td>
                    <!--                    [{$vo.mname}]-->
                    <a href="<?php echo ROOTAPP ?>/label/admin_curl/cid-{$vo['cid']}.php"
                       target="_blank">{$vo.cname}</a>
                    <@if:{$vo['image']<>''}>
                    <a href="javascript:;" rel="{$vo.image}" class="class_pic"><img align="AbsMiddle"
                                                                                    src="__PUBLICURL__/images/ico/pic.png"
                                                                                    width="14" height="14" alt=""/></a>
                    <@/if>
                </td>
                <td>
                    <center>
                        <input type="text" value="{$vo.sequence}" class="sequence"
                               onblur="sequence({$vo['cid']},$(this).val())"/>

                    </center>
                </td>
                <td>
                    <center>
                        <@if:{$vo['show']==1}>
                        <font color=green><b>√</b></font>
                        <@else>
                        <font color=red><b>×</b></font>
                        <@/if>
                    </center>
                </td>
                <td>
                    <center>
                        <@if:{$vo['mname']=='内容'}>
                        <@if:{$vo['type']==0}>
                        频道
                        <@else>
                        列表
                        <@/if>
                        <@else>
                        -
                        <@/if>
                    </center>
                </td>
                <td>
                    <center>
                        <a href="__APP__/{$vo.admin_category}/edit/id-{$vo.cid}">修改</a>
                        | <a href="javascript:void(0);"
                             onclick="del('__APP__/{$vo.admin_category}/del','{$vo.cid}',this)">删除</a></center>
                </td>
            </tr>
            <@/foreach>
        </table>
    </div>
</div>

<div class="page_tool">
    <div class="page"></div>
</div>
<script>
    //栏目缩略图
    $(".class_pic").powerFloat({
        targetMode: "ajax"
    });
    //栏目删除
    function del(url, cid, obj) {
        ajaxpost(
            '删除此栏目会删除栏目下的内容!',
            url,
            {cid: cid},
            1,
            function () {
                $(obj).parent().parent().parent().remove();
            }
        );
    }
    //栏目排序
    function sequence(cid, sid) {
        ajaxpost_w(
            '__URL__/sequence',
            { cid: cid, sequence: sid },
            1
        );
    }
</script>