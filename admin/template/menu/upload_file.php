<div class="title"><a href="javascript:void(0)">附件管理</a></div>
<ul class="load menu">
    <@foreach:{$list $vo}>
    <li><a href="__APP__/{$vo.module}">{$vo.name}</a></li>
    <@/foreach>
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