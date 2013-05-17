<ul class="load menu">
    <li><a href="__APP__/index/home">系统信息</a></li>
    <@foreach:{$list $vo}>
    <li><a href="__APP__/{$vo.module}">{$vo.name}</a></li>
    <@/foreach>
</ul>

<script>
    url = $(".load li:first a").attr("href");
    if (url == '' || url == '#') {
    } else {
        ajaxload(url);
    }
</script>