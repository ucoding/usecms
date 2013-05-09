<div class="page_function">
    <form action="__APP__/setting/save/time-time()" id="form" name="form" method="post">
        <div class="info">
            <h3>系统设置</h3>
            <small>设置站点信息与网站的性能等</small>
        </div>
</div>
<div class="tab" id="tab"><a class="selected" href="#tab1">站点设置</a><a href="#tab2">性能设置</a>
<!--    <a href="#tab3">模板设置</a> -->
    <a
        href="#tab4">上传设置</a></div>
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
            <td width="120">网站域名</td>
            <td width="300"><input name="siteurl" type="text" class="text_value" id="siteurl"
                                   value="{$config_array.siteurl}"/></td>
            <td>{<span>$</span>sys.siteurl}</td>
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
        <tr>
            <td width="120">授权码</td>
            <td width="300"><input name="AUTHO_KEY" type="text" class="text_value" id="AUTHO_KEY"
                                   value="{$config_array.AUTHO_KEY}"/></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</div>
<div class="page_table form_table" id="tab2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="120">错误信息输出：</td>
            <td width="300"><?php if ($config_array['DEBUG']) { ?>
                    <input type="radio" name="DEBUG" id="DEBUG" value="true" checked="checked"/>
                    开启
                    <input type="radio" name="DEBUG" value="false"/>
                    关闭
                <?php } else { ?>
                    <input type="radio" name="DEBUG" value="true"/>
                    开启
                    <input type="radio" name="DEBUG" id="DEBUG" value="false" checked="checked"/>
                    关闭
                <?php } ?></td>
            <td>开启将会显示详细错误信息</td>
        </tr>
        <tr>
            <td>DEBUG模式：</td>
            <td><?php if ($config_array['ERROR_HANDLE']) { ?>
                    <input type="radio" name="ERROR_HANDLE" id="ERROR_HANDLE" value="true" checked="checked"/>
                    开启
                    <input type="radio" name="ERROR_HANDLE" value="false"/>
                    关闭
                <?php } else { ?>
                    <input type="radio" name="ERROR_HANDLE" value="true"/>
                    开启
                    <input type="radio" name="ERROR_HANDLE" id="ERROR_HANDLE" value="false" checked="checked"/>
                    关闭
                <?php } ?></td>
            <td>开启DEBUG模式将会显示严格的调试信息，非开发者请勿开启。</td>
        </tr>
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

<!--<div class="page_table form_table" id="tab3">-->
<!--    <table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--        <tr>-->
<!--            <td width="120">模板路径</td>-->
<!--            <td width="300"><input name="TPL_TEMPLATE_PATH" type="text" class="text_value" id="TPL_TEMPLATE_PATH"-->
<!--                                   value="{$config_array.TPL_TEMPLATE_PATH}"/></td>-->
<!--            <td>针对themes目录下的文件夹</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td width="120">首页模板</td>-->
<!--            <td width="300"><input name="TPL_INDEX" type="text" class="text_value" id="TPL_INDEX"-->
<!--                                   value="{$config_array.TPL_INDEX}"/></td>-->
<!--            <td>定义首页访问的模板</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td width="120">公共模板</td>-->
<!--            <td width="300"><input name="TPL_COMMON" type="text" class="text_value" id="tpl_common"-->
<!--                                   value="{$config_array.TPL_COMMON}"/></td>-->
<!--            <td>公共模板用于tag、搜索、插件等模板的外部模板</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td width="120">搜索模板</td>-->
<!--            <td width="300"><input name="TPL_SEARCH" type="text" class="text_value" id="TPL_SEARCH"-->
<!--                                   value="{$config_array.TPL_SEARCH}"/></td>-->
<!--            <td>定义网站搜索的模板</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td width="120">TAG模板</td>-->
<!--            <td width="300"><input name="TPL_TAGS" type="text" class="text_value" id="TPL_TAGS"-->
<!--                                   value="{$config_array.TPL_TAGS}"/></td>-->
<!--            <td>定义网站TAG的模板</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>模板缓存：</td>-->
<!--            <td>--><?php //if ($config_array['TPL_CACHE_ON']) { ?>
<!--                    <input type="radio" name="TPL_CACHE_ON" id="TPL_CACHE_ON" value="true" checked="checked"/>-->
<!--                    开启-->
<!--                    <input type="radio" name="TPL_CACHE_ON" value="false"/>-->
<!--                    关闭-->
<!--                --><?php //} else { ?>
<!--                    <input type="radio" name="TPL_CACHE_ON" value="true"/>-->
<!--                    开启-->
<!--                    <input type="radio" name="TPL_CACHE_ON" id="TPL_CACHE_ON" value="false" checked="checked"/>-->
<!--                    关闭-->
<!--                --><?php //} ?><!--</td>-->
<!--            <td>更换修改模板请先清除缓存</td>-->
<!--        </tr>-->
<!--    </table>-->
<!--</div>-->

<div class="page_table form_table" id="tab4">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="120">上传大小：</td>
            <td width="300"><input class="text_value" type='text' value="{$config_array.ACCESSPRY_SIZE}"
                                   name="ACCESSPRY_SIZE" id="ACCESSPRY_SIZE"/></td>
            <td>单位:M</td>
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
        <tr>
            <td>默认水印位置：</td>
            <td><select name="WATERMARK_PLACE" id="WATERMARK_PLACE">
                    <option
                        value="0" <?php if ($config_array['WATERMARK_PLACE'] == 0) { ?> selected="selected" <?php } ?>>
                        随机
                    </option>
                    <option
                        value="1" <?php if ($config_array['WATERMARK_PLACE'] == 1) { ?> selected="selected" <?php } ?> >
                        左上
                    </option>
                    <option
                        value="2" <?php if ($config_array['WATERMARK_PLACE'] == 2) { ?> selected="selected" <?php } ?> >
                        中上
                    </option>
                    <option
                        value="3" <?php if ($config_array['WATERMARK_PLACE'] == 3) { ?> selected="selected" <?php } ?>>
                        右上
                    </option>
                    <option
                        value="4" <?php if ($config_array['WATERMARK_PLACE'] == 4) { ?> selected="selected" <?php } ?>>
                        左中
                    </option>
                    <option
                        value="5" <?php if ($config_array['WATERMARK_PLACE'] == 5) { ?> selected="selected" <?php } ?>>
                        正中
                    </option>
                    <option
                        value="6" <?php if ($config_array['WATERMARK_PLACE'] == 6) { ?> selected="selected" <?php } ?>>
                        右中
                    </option>
                    <option
                        value="7" <?php if ($config_array['WATERMARK_PLACE'] == 7) { ?> selected="selected" <?php } ?>>
                        左下
                    </option>
                    <option
                        value="8" <?php if ($config_array['WATERMARK_PLACE'] == 8) { ?> selected="selected" <?php } ?>>
                        中下
                    </option>
                    <option
                        value="9" <?php if ($config_array['WATERMARK_PLACE'] == 9) { ?> selected="selected" <?php } ?>>
                        右下
                    </option>
                </select></td>
            <td></td>
        </tr>
        <tr>
            <td>水印图片：</td>
            <td><input class="text_value" type='text' value="{$config_array.WATERMARK_IMAGE}" name="WATERMARK_IMAGE"
                       id="WATERMARK_IMAGE"/></td>
            <td></td>
        </tr>
    </table>
</div>
</div>
<div class="form_submit">
    <button type="submit" class="button">保存</button>
</div>
</form>
</div>
<script type="text/javascript">
    //提交表单
    saveform(function (msg) {
        $.dialog.tips(msg, 3)
    });
    //tab菜单
    $("#tab").idTabs();
</script>