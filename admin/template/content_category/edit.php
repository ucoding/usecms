<div class="page_function">
    <div class="info">
        <h3>编辑栏目</h3>
        <small>使用以下功能进行栏目编辑操作</small>
    </div>
</div>
<div class="tab" id="tab">
    <a class="selected" href="#tab1">基本属性</a>
    <a href="#tab2">高级设置</a>
</div>
<div class="page_form">
    <form action="__URL__/edit_save/time-<?php echo time(); ?>-ajax-true" method="post" id="form">
        <div class="page_table form_table" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">上级栏目</td>
                    <td width="300">
                        <select name="pid" id="pid">
                            <option value="0">=====顶级栏目=====</option>
                            <@foreach:{$category_list $vo}>
                            <option
                            <@if:{$vo['cid']==$info['pid']}>selected="selected"<@/if>
                            value="{$vo.cid}">{$vo.cname}</option>
                            <@/foreach>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目名称</td>
                    <td width="300">
                        <input name="name" type="text" class="text_value" id="name" value="{$info.name}" reg="\S"
                               msg="栏目名称不能为空"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目缩略图</td>
                    <td colspan="2">
                        <?php echo module('editor')->get_image_upload('image1', 'image') ?>
                        <input name="image" type="text" class="text_value" id="image" style="width:200px; float:left"
                               value="{$info.image}"/>
                        &nbsp;&nbsp;<input type="button" id="image1" class="button_small" value="选择图片"/>

                    </td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目属性</td>
                    <td width="300">
                        <input name="type" type="radio" value="0" <@if:{$info['type']==0}>checked="checked"
                        <@/if> />
                        频道页
                        &nbsp;&nbsp;
                        <input name="type" type="radio" value="1" <@if:{$info['type']==1}>checked="checked"
                        <@/if> />
                        列表页
                    </td>
                    <td>频道页无法发布内容，列表页可以发布内容</td>
                </tr>
                <tr>
                    <td width="100" align="right">内容分页数</td>
                    <td width="300">
                        <input name="page" type="text" class="text_value" id="page" value="{$info.page}"/>
                    </td>
                    <td>栏目下内容每页多少条</td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目顺序</td>
                    <td width="300">
                        <input name="sequence" type="text" class="text_value" id="sequence" value="{$info.sequence}"/>
                    </td>
                    <td>数字越大越在前面</td>
                </tr>
                <?php module('common')->plus_hook('category', 'edit_tpl', $info); ?>
                <tr>
                    <td width="100" align="right">栏目模板</td>
                    <td width="300">
                        <input name="class_tpl" type="text" class="text_value" id="class_tpl"
                               value="{$info.class_tpl}"/>
                    </td>
                    <td>用于频道或列表的显示</td>
                </tr>
                <tr>
                    <td width="100" align="right">内容模板</td>
                    <td width="300">
                        <input name="content_tpl" type="text" class="text_value" id="content_tpl"
                               value="{$info.content_tpl}"/>
                    </td>
                    <td>用于该栏目下的内容显示</td>
                </tr>
                <tr>
                    <td width="100" align="right">扩展模型</td>
                    <td width="300">
                        <select name="expand" id="expand">
                            <option value="0">无</option>
                            <@foreach:{$model_list $vo}>
                            <option
                                value="{$vo.mid}" <?php if ($vo['mid'] == $info['expand']) { ?> selected="selected" <?php } ?> >
                                {$vo.name}
                            </option>
                            <@/foreach>
                        </select>
                    </td>
                    <td>用于附加内容字段</td>
                </tr>
            </table>
        </div>
        <div class="page_table form_table" id="tab2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100" align="right">栏目URL优化</td>
                    <td width="300">
                        <input name="urlname" type="text" class="text_value" id="urlname" value="{$info.urlname}"/>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO关键词</td>
                    <td width="300">
                        <input name="keywords" type="text" class="text_value" id="keywords" value="{$info.keywords}"/>
                    </td>
                    <td>以,号分割</td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO描述</td>
                    <td width="300"><textarea name="description" class="text_textarea" id="description">{$info.description}</textarea>
                    </td>
                    <td>对本栏目的简单介绍</td>
                </tr>
                <tr>
                    <td width="100" align="right">SEO内容</td>
                    <td><textarea name="seo_content" class="text_textarea" id="seo_content">{$info.seo_content
                            html}</textarea>
                    </td>
                    <td>可以填写HTML代码</td>
                </tr>
                <tr>
                    <td width="100" align="right">栏目显示</td>
                    <td width="300">
                        <input name="show" type="radio" value="1" <@if:{$info['show']==1}>checked="checked"
                        <@/if> />
                        显示
                        &nbsp;&nbsp;
                        <input name="show" type="radio" value="0" <@if:{$info['show']==0}>checked="checked"
                        <@/if> />
                        隐藏
                    </td>
                    <td>控制栏目调用的显示与隐藏</td>
                </tr>
                <tr>
                    <td width="100" align="right">内容排序</td>
                    <td width="300">
                        <select name="content_order">
                            <option
                            <@if:{$info['content_order']=='updatetime DESC'}> selected="selected" <@/if>
                            value="updatetime DESC">内容更新时间 新-旧</option>
                            <option
                            <@if:{$info['content_order']=='updatetime ASC'}> selected="selected" <@/if>
                            value="updatetime ASC">内容更新时间 旧-新</option>
                            <option
                            <@if:{$info['content_order']=='inputtime DESC'}> selected="selected" <@/if>
                            value="inputtime DESC">内容发布时间 新-旧</option>
                            <option
                            <@if:{$info['content_order']=='inputtime ASC'}> selected="selected" <@/if>
                            value="inputtime ASC">内容发布时间 旧-新</option>
                            <option
                            <@if:{$info['content_order']=='order DESC'}> selected="selected" <@/if>
                            value="order DESC">内容自定义排序 大-小</option>
                            <option
                            <@if:{$info['content_order']=='order ASC'}> selected="selected" <@/if>
                            value="order ASC">内容自定义排序 小-大</option>
                        </select>
                    </td>
                    <td>针对该栏目下内容的排序方式</td>
                </tr>
                <tr>
                    <td width="100" align="right">扩展模型</td>
                    <td width="300">
                        <select name="expand" id="expand">
                            <option value="0">无</option>
                            <@foreach:{$model_list $vo}>
                            <option
                                value="{$vo.mid}" <?php if ($vo['mid'] == $info['expand']) { ?> selected="selected" <?php } ?> >
                                {$vo.name}
                            </option>
                            <@/foreach>
                        </select>
                    </td>
                    <td>用于附加内容字段</td>
                </tr>
            </table>
        </div>
        <div class="form_submit">
            <input name="file_id" id="file_id" type="hidden" value="{$file_id}"/>
            <input name="cid" type="hidden" value="{$info.cid}"/>
            <button type="submit" class="button">保存</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    //提交表单
    savelistform("__URL__/add", "__APP__/category");
    $(function () {
        //tab菜单
        $("#tab").idTabs();
    });


</script>