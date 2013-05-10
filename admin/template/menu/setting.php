<div class="title"><a href="javascript:void(0)">系统设置</a></div>
<ul class="load menu">
    <!--foreach:{$list $vo}-->
    <li><a href="__APP__/{$vo.module}">{$vo.name}</a></li>
    <!--{/foreach}-->

</ul>

<script>
    url = $(".load li:first a").attr("href");
    if (url == '' || url == '#') {
    } else {
        ajaxload(url);
    }
</script>