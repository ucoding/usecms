<div class="title"><a href="javascript:void(0)">多用表单</a></div>
<ul class="load menu">
    <li><a href="__APP__/form/index">表单设置</a></li>
    <!--foreach:{$list $vo}-->
    <li><a href="__APP__/form_list/index/id-{$vo.id}">{$vo.name}</a></li>
    <!--{/foreach}-->
</ul>

<script>
    <?php if($_GET['load']<>1){ ?>
    url = $(".load li:first a").attr("href");
    if (url == '' || url == '#') {
    } else {
        ajaxload(url);
    }
    <?php } ?>
</script>