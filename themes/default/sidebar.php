<div class="box">
    <div class="boxhead">
        <h3>热门内容</h3>
    </div>
    <div class="boxlist">
        <ul>
            <@list:{table="content" cid="<$top_category.cid>" type="sub" order="views desc"  limit="10"}>
            <li><span class="num">{$list.i}</span> <span class="title"><a href="{$list.aurl}" title="{$list.title}">{$list.title
                        len="13"}</a> </span></li>
            <@/list>
        </ul>
    </div>
</div>

<div class="box">
    <div class="boxhead">
        <h3>随机内容</h3>
    </div>
    <div class="boxlist">
        <ul>
            <@list:{table="content" rand="true" cid="<$top_category.cid>"  type="sub" limit="9"}>
            <li><span class="num">{$list.i}</span> <span class="title"><a href="{$list.aurl}" title="{$list.title}">{$list.title
                        len="13"}</a> </span></li>
            <@/list>
        </ul>
    </div>
</div>
