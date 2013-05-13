<?php
class labelMod extends commonMod
{

    public function __construct()
    {
        parent::__construct();
    }

    //解析循环标签
    public function getlist($data)
    {
        if (empty($data)) {
            return;
        }
        $data = stripslashes($data);
        preg_match_all('/([a-z0-9_]+)=\"(.*)\"/iU', $data, $matches);
        $label = array_combine($matches[1], $matches[2]);
        $table = $label['table'];

        //转换标签
        $where = $this->get_where($label);

        switch ($table) {
            case 'content':
                return $this->get_content($where, $label);
                break;
            case 'category':
                return $this->get_category($where, $label);
                break;
            case 'tags':
                return $this->get_tags($where, $label);
                break;
            default:
                return $this->get_common($where, $label);
                break;
        }
    }

    //栏目获取
    public function get_category($where)
    {
        $condition = '`show`=1' . $where['mid'] . $where['cid'] . $where['pid'] . $where['type'] . $where['where'];
        $langwhere = ' AND A.lang=' . model('lang')->langid();
        return $this->model->table('category', 'A')->where($condition . $langwhere)->cache($where['cache'])->limit($where['limit'])->order('sequence desc , ' . $where['order'])->select();
    }

    //内容获取
    public function get_content($where, $data)
    {
        $condition = 'A.status=1' . $where['mid'] . $where['cid'] . $where['image'] . $where['position'] . $where['where'];
        $langwhere = ' AND B.lang=' . model('lang')->langid();
        //获取推荐位
        if ($where['position']) {
            $position = "LEFT JOIN {$this->model->pre}position_relation R ON R.aid = A.aid LEFT JOIN {$this->model->pre}position P ON P.id = R.pid";
        }
        //获取扩展模型
        $data['cid'] = intval($data['cid']);
        if (is_int($data['cid']) || !empty($data['expand'])) {
            if (empty($data['expand'])) {
                $category = model('category')->info($data['cid']);
                $expand_id = $category['expand'];
            } else {
                $expand_id = $data['expand'];
            }
            if (!empty($expand_id)) {
                $model_info = model('category')->expand_model_info($expand_id);
                $expand = "LEFT JOIN {$this->model->pre}expand_content_{$model_info['table']} C ON C.aid = A.aid";
                $expand_field = "C.*,";
            }
        }
        if ($where['order'] <> 'rand()') {
            if (substr($where['order'], 1) <> 'B' || substr($where['order'], 1) <> 'C') {
                $where['order'] = 'A.' . $where['order'];
            }
        }
        //获取相关文章
        if (!empty($data['related'])) {
            if (preg_match("/[^\d-., ]/", $data['related'])) {
                $tag_array = explode(',', $data['related']);
                $tagid = '';
                if (!empty($tag_array)) {
                    foreach ($tag_array as $value) {
                        $tag = model('tags')->tag_info($value);
                        if (!empty($tag)) {
                            $tagid .= $tag['id'] . ',';
                        }
                        unset($tag);
                    }
                }
            } else {
                $tag_array = model('tags')->tags_relation_aid($data['related']);
                if (!empty($tag_array)) {
                    $tagid = '';
                    foreach ($tag_array as $value) {
                        $tagid .= $value['tid'] . ',';
                    }
                }

            }
            $tagid = substr($tagid, 0, -1);
            if (!empty($tagid)) {
                $tags_relation = model('tags')->tags_relation_tid($tagid);
                if (!empty($tags_relation)) {
                    $tags_aid = '';
                    foreach ($tags_relation as $value) {
                        $tags_aid .= $value['aid'] . ',';
                    }
                    $tags_aid = substr($tags_aid, 0, -1);
                }
            }
            if (!empty($tags_aid)) {
                $related = " AND A.aid in(" . $tags_aid . ") ";
                if (preg_match("/[^\d-., ]/", $data['related'])) {
                    $related .= ' AND A.aid<>' . $related_id;
                }
            } else {
                return;
            }
        }

        $loop = "
            SELECT {$expand_field}A.*,B.name as cname,B.mid
             FROM {$this->model->pre}content A 
             LEFT JOIN {$this->model->pre}category B ON A.cid = B.cid
             {$position}
             {$expand}
             WHERE {$condition}{$related} ORDER BY {$where['order']} LIMIT {$where['limit']}
            ";
        return $this->model->query($loop);
    }

    //其他表获取
    public function get_common($where, $data)
    {
        $condition = @substr($where['where'], 4);
        $list = @$this->model->table($data['table'])->where($condition)->limit($where['limit'])->order($where['order'])->select();
        return $list;
    }

    //获取数据统计
    public function get_count($where, $data)
    {
        $condition = @substr($where['where'], 4);
        $count = @$this->model->table($data['table'])->where($condition)->count();
        return $count;
    }

    //获取TAG列表
    public function get_tags($where, $data)
    {
        $condition = $where['aid'] . $where['where'];
        if ($condition) {
            $list = $this->model
                ->field('A.*,B.aid')
                ->table('tags', 'A')
                ->add_table('tags_relation', 'B', 'A.id=B.tid')
                ->where('A.name <> "" ' . $condition)
                ->limit($where['limit'])
                ->order($where['order'])
                ->select();
        } else {
            $list = $this->model->table('tags')->limit($where['limit'])->order($where['order'])->select();
        }
        return $list;
    }

    //解析万能表单
    public function get_form($data)
    {
        if (empty($data)) {
            return;
        }
        //解析标签
        $data = stripslashes($data);
        preg_match_all('/([a-z0-9_]+)=\"(.*)\"/iU', $data, $matches);
        $label = array_combine($matches[1], $matches[2]);
        $table = 'form_data_' . $label['table'];

        //获取表单信息
        $list = $this->model->table($table)->where($label['where'])->limit($label['limit'])->order($label['order'])->select();
        return $list;
    }

    public function admin_aurl()
    {
        $aid = intval($_GET['aid']);
        if (!empty($aid)) {
            $this->redirect($this->get_aurl($aid));
        } else {
            $this->error404();
        }
    }

    public function admin_curl()
    {
        $cid = intval($_GET['cid']);
        if (!empty($cid)) {
            $this->redirect($this->get_curl($cid));
        } else {
            $this->error404();
        }
    }


    //栏目超链接
    public function get_curl($cid, $app = '')
    {
        if (empty($app)) {
            $app = __APP__;
        }
        $condition['cid'] = $cid;
        $info = $this->model->field('cid,mid,urlname')->table('category')->where($condition)->find();
        if (empty($info)) {
            return;
        }
        $model = $this->model->field('url_category')->table('model')->where('mid=' . $info['mid'])->find();
        if (empty($model)) {
            return;
        }

        $url_catrgory = $model['url_category'];
        $patterns = array(
            "/{EXT}/",
            "/{CDIR}/",
        );
        $replacements = array(
            '.html',
            $info['urlname'],
        );
        $url_catrgory = preg_replace($patterns, $replacements, $url_catrgory);
        return $app . '/' . $url_catrgory;
    }

    //内容超链接
    public function get_aurl($aid, $app = '')
    {
        if (empty($app)) {
            $app = __APP__;
        }

        $condition['aid'] = $aid;
        $info = $this->model->table('content')->where($condition)->find();
        if (empty($info)) {
            return;
        }
        $channel_info = $this->model->field('cid,mid,urlname')->table('category')->where('cid=' . $info['cid'])->find();
        if (empty($channel_info)) {
            return;
        }
        $model = $this->model->field('url_content')->table('model')->where('mid=' . $channel_info['mid'])->find();
        if (empty($model)) {
            return;
        }

        $url_content = $model['url_content'];
        $patterns = array(
            "/{EXT}/",
            "/{CDIR}/",
            "/{AID}/",
            "/{URLTITLE}/",
        );
        $replacements = array(
            '.html',
            $channel_info['urlname'],
            $info['aid'],
            $info['urltitle'],
        );
        $url_content = preg_replace($patterns, $replacements, $url_content);
        return $app . '/' . $url_content;
    }

    //表单超链接
    public function get_furl($name)
    {
        return __APP__ . '/' . $name . '/';
    }

    //转换条件
    public function get_where($get)
    {

        //基本条件
        $where['limit'] = $get['limit'];
        $where['order'] = $get['order'];

        //缓存
        if ($get['cache']) {
            $where['cache'] = $get['cache'];
        }

        //模型ID
        if ($get['mid']) {
            if ($get['table'] == 'category') {
                $where['mid'] = ' AND A.mid=' . $get['mid'];
            } else {
                $where['mid'] = ' AND B.mid=' . $get['mid'];
            }
        }
        //栏目ID
        if ($get['cid']) {
            if ($get['table'] == 'category') {
                $where['cid'] = ' AND cid in(' . $get['cid'] . ')';
            } else {
                $where['cid'] = ' AND B.cid in(' . $get['cid'] . ')';
            }
        }

        //上级栏目ID
        if ($get['pid']) {
            $where['pid'] = ' AND pid in(' . $get['pid'] . ')';
        }
        //调用所有次级栏目
        if ($get['type'] == 'sub' && !empty($get['pid'])) {
            $where['pid'] = ' AND pid in (' . model('category')->getcat($get['pid']) . ')';
        }

        //获取次级栏目内容
        if ($get['type'] == 'sub' && !empty($get['cid'])) {
            if ($get['table'] == 'content') {
                $where['cid'] = " AND B.cid in (" . model('category')->getcat($get['cid']) . ")";
            }
        }

        //调用顶级栏目
        if ($get['type'] == 'top') {
            $where['pid'] = ' AND pid=0';
        }

        //判断图片是否显示
        if (!empty($get['image'])) {
            if ($get['image'] == 'true') {
                $where['image'] = ' AND A.image<>"" ';
            }
            if ($get['image'] == 'false') {
                $where['image'] = ' AND A.image is Null ';
            }
        }
        //判断推荐内容
        if ($get['position']) {
            $where['position'] = " AND P.id=" . intval($get['position']) . ' ';
        }

        //调用栏目类型
        if ($get['att'] == 'list') {
            $where['type'] = ' AND A.type=1 ';
        }

        if ($get['att'] == 'class') {
            $where['type'] = ' AND A.type=0 ';
        }

        //调用附加条件
        if (!empty($get['where'])) {
            $where['where'] = ' AND ' . $get['where'];
        }

        //随机排序
        if (!empty($get['rand'])) {
            unset($where['order']);
            $where['order'] = 'rand()';
        }

        //针对TAG
        if (!empty($get['aid'])) {
            $where['aid'] = ' AND B.aid =' . $get['aid'];
        }


        return $where;
    }


}