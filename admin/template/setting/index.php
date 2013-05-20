<div class="page_function">
    <form action="__APP__/setting/save/time-time()" id="form" name="form" method="post">
        <div class="info">
            <h3>系统设置</h3>

        </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#tab1">站点设置</a>
    <a href="#tab2">缓存设置</a>
    <a href="#tab3">模板设置</a>
    <a href="#tab4">上传设置</a>
</div>
<div class="page_form">
    <div class="page_table form_table" id="tab1">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">网站名称</td>
                <td width="300"><input name="sitename" type="text" class="text_value" id="sitename"
                                       value="{$config_array.sitename}"/></td>
                <td>{<span>$</span>sys.sitename}</td>
            </tr>
            <tr>
                <td width="120">网站副标题</td>
                <td width="300"><input name="seoname" type="text" class="text_value" id="seoname"
                                       value="{$config_array.seoname}"/></td>
                <td>{<span>$</span>sys.seoname}</td>
            </tr>
            <tr>
                <td width="120">站点关键词</td>
                <td width="300"><input name="keywords" type="text" class="text_value" id="keywords"
                                       value="{$config_array.keywords}"/></td>
                <td>{<span>$</span>sys.keywords}</td>
            </tr>
            <tr>
                <td width="120">站点描述</td>
                <td width="300"><textarea name="description" class="text_textarea" id="description">{$config_array.description}</textarea>
                </td>
                <td>{<span>$</span>sys.description}</td>
            </tr>
            <tr>
                <td width="120">站长邮箱</td>
                <td width="300"><input name="masteremail" type="text" class="text_value" id="masteremail"
                                       value="{$config_array.masteremail}"/></td>
                <td>{<span>$</span>sys.masteremail}</td>
            </tr>
            <tr>
                <td width="120">版权信息</td>
                <td width="300"><input name="copyright" type="text" class="text_value" id="copyright"
                                       value="{$config_array.copyright}"/></td>
                <td>{<span>$</span>sys.copyright}</td>
            </tr>
        </table>
    </div>
    <div class="page_table form_table" id="tab2">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>伪静态模式：</td>
                <td><?php if ($config_array['URL_REWRITE_ON']) { ?>
                        <input type="radio" name="URL_REWRITE_ON" id="URL_REWRITE_ON" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="URL_REWRITE_ON" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="URL_REWRITE_ON" value="true"/>
                        开启
                        <input type="radio" name="URL_REWRITE_ON" id="URL_REWRITE_ON" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td>开启伪静态请先设置相应的伪静态规则</td>
            </tr>
            <tr>
                <td>智能生成静态：</td>
                <td><?php if ($config_array['HTML_CACHE_ON']) { ?>
                        <input type="radio" name="HTML_CACHE_ON" id="HTML_CACHE_ON" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="HTML_CACHE_ON" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="HTML_CACHE_ON" value="true"/>
                        开启
                        <input type="radio" name="HTML_CACHE_ON" id="HTML_CACHE_ON" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td> 开启静态缓存后更改模板与设置请先清除缓存</td>
            </tr>
            <tr>
                <td>数据库缓存：</td>
                <td><?php if ($config_array['DB_CACHE_ON']) { ?>
                        <input type="radio" name="DB_CACHE_ON" id="DB_CACHE_ON" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="DB_CACHE_ON" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="DB_CACHE_ON" value="true"/>
                        开启
                        <input type="radio" name="DB_CACHE_ON" id="DB_CACHE_ON" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td>建议网站上线后开启</td>
            </tr>
            <tr>
                <td>清除全部缓存：</td>
                <td><a href="javascript:clear('1')" class="float_list_a">清除所有缓存</a></td>
                <td></td>
            </tr>
            <tr>
                <td>清除模板缓存：</td>
                <td><a href="javascript:clear('2')" class="float_list_a">清除模板缓存</a></td>
                <td></td>
            </tr>
            <tr>
                <td>清除静态缓存：</td>
                <td><a href="javascript:clear('3')" class="float_list_a">清除静态缓存</a></td>
                <td></td>
            </tr>
            <tr>
                <td>清除数据缓存：</td>
                <td><a href="javascript:clear('4')" class="float_list_a">清除数据缓存</a></td>
                <td></td>
            </tr>

        </table>
    </div>
    <div class="page_table form_table" id="tab3">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>多国语言：</td>
                <td>
                    <?php if ($config_array['LANG_OPEN']) { ?>
                        <input type="radio" name="LANG_OPEN" id="LANG_OPEN" value="true" checked="checked"/>
                        开启
                        <input type="radio" name="LANG_OPEN" value="false"/>
                        关闭
                    <?php } else { ?>
                        <input type="radio" name="LANG_OPEN" value="true"/>
                        开启
                        <input type="radio" name="LANG_OPEN" id="LANG_OPEN" value="false" checked="checked"/>
                        关闭
                    <?php } ?></td>
                <td> 注意：开启多国语言后模板目录会有所变更，请自行修改。</td>
            </tr>
        </table>
    </div>
    <div class="page_table form_table" id="tab4">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="120">上传大小：</td>
                <td width="300"><input class="text_value" type='text' value="{$config_array.ACCESSPRY_SIZE}"
                                       name="ACCESSPRY_SIZE" id="ACCESSPRY_SIZE"/></td>
                <td>单位:k</td>
            </tr>
            <tr>
                <td>批量上传数：</td>
                <td><input class="text_value" type='text' value="{$config_array.ACCESSPRY_NUM}" name="ACCESSPRY_NUM"
                           id="ACCESSPRY_NUM"/></td>
                <td></td>
            </tr>
            <tr>
                <td>上传格式：</td>
                <td><input name="ACCESSPRY_TYPE" type='text' class="text_value" value="{$config_array.ACCESSPRY_TYPE}"
                           id="ACCESSPRY_TYPE"/></td>
                <td></td>
            </tr>
            <tr>
                <td>默认缩图尺寸：</td>
                <td>最大宽度
                    <input style="width:50px;" class="text_value" type='text' value="{$config_array.THUMBNAIL_MAXWIDTH}"
                           name="THUMBNAIL_MAXWIDTH" id="THUMBNAIL_MAXWIDTH"/>
                    &nbsp;&nbsp;最大高度
                    <input style="width:50px;" class="text_value" type='text' value="{$config_array.THUMBNAIL_MAXHIGHT}"
                           name="THUMBNAIL_MAXHIGHT" id="THUMBNAIL_MAXHIGHT"/></td>
                <td>单位:px</td>
            </tr>
        </table>
    </div>
</div>
<div class="form_submit">
    <button type="submit" class="button">保存</button>
</div>
<script type="text/javascript">
    //清除缓存
    function clear(type) {
        var url;
        switch (type) {
            case '1':
                url = "__APP__/cache/clear_all";
                break;
            case '2':
                url = "__APP__/cache/clear_tpl";
                break;
            case '3':
                url = "__APP__/cache/clear_html";
                break;
            case '4':
                url = "__APP__/cache/clear_data";
                break;
        }


        $.get(url, function (json) {
            $.dialog.tips(json.message, 3);
            $('#floatBox_list').hide();
        }, 'json');
    }

    //提交表单
    saveform(function (msg) {
        $.dialog.tips(msg, 3)
    });
    //tab菜单
    $("#tab").idTabs();
</script>