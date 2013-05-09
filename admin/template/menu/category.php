<div class="title"><a href="javascript:void(0)">栏目管理</a></div>
<ul class="load menu">
    <!--foreach:{$list $vo}-->
    <li><a href="__APP__/{$vo.module}">{$vo.name}</a></li>
    <!--{/foreach}-->
    <!--if:{!empty($list)}-->
    <!--foreach:{$model_list $vo}-->
    <li><a href="__APP__/{$vo.admin_category}/add">添加{$vo.name}栏目</a></li>
    <!--{/foreach}-->
    <!--{/if}-->
</ul>
<script>
    url = $(".load li:first a").attr("href");
    if (url == '' || url == '#') {
    } else {
        ajaxload(url);
    }
</script>