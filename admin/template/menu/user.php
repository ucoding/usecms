<script>
    var menu=[];
    <@foreach:{$list $vo}>
    menu.push({
        title:"{$vo.name}",
        url:"__APP__/{$vo.module}"
    });
    <@/foreach>
    url = menu[0].url;
    if (url == '' || url == '#') {
    } else {
        top.main_load(url);
    }
</script>