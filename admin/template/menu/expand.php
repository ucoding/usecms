
<script>
    var menu=[];
    <@foreach:{$formlist $form}>
    menu.push({
        title:"{$form.name}",
        url:"__APP__/form_list/index/id-{$form.id}"
    });
    <@/foreach>
    var url = menu[0].url;
    if (url == '' || url == '#') {
    } else {
        top.main_load(url);
    }
</script>