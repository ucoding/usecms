<div class="warp">
    <div id="foot">
        <div class="menu">
            <a href="__APP__/">网站首页</a>
            <@list:{table="category" type="top" order="cid asc" limit="10"}>
                | <a href="{$list.curl}">{$list.name}</a>
                <@/list>
        </div>
        <div id="copyright"> {$sys.copyright}{$my.dibu}</div>
    </div>
</div>