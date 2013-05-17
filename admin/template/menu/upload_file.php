<script>
    <?php if($_GET['load']<>1){ ?>
    var menu=[];
    <@foreach:{$list $vo}>
    menu.push({
        title:"{$vo.name}",
        url:"__APP__/{$vo.module}"
    });
    <@/foreach>
    var url = menu[0].url;
    if (url == '' || url == '#') {
    } else {
        top.main_load(url);
    }
    <?php } ?>
</script>