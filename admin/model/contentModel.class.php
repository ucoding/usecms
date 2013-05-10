<?php
class contentModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //内容列表
    public function content_list($cid, $limit = null, $where = null, $order = null, $all = false)
    {
        if (!$all) {
            if (empty($cid)) {
                return;
            }
            $where_cid = 'A.cid=' . $cid;
        }
        $data = $this->model->field('A.*,B.name as cname,B.mid,C.admin_content')
            ->table('content', 'A')
            ->add_table('category', 'B', 'A.cid = B.cid')
            ->add_table('model', 'C', 'C.mid = B.mid')
            ->order($order . 'A.updatetime DESC,A.aid DESC')
            ->where($where_cid . $where)
            ->limit($limit)
            ->select();
        return $data;
    }

    //获取内容统计
    public function count($cid, $where = null, $all = false)
    {
        if (!$all) {
            if (empty($cid)) {
                return;
            }
            $where_cid = 'A.cid=' . $cid;
        }
        $data = $this->model->field('A.*,B.name as cname,B.mid')
            ->table('content', 'A')
            ->add_table('category', 'B', 'A.cid = B.cid')
            ->where($where_cid . $where)
            ->count();
        return $data;
    }

    //基础表信息
    public function add_save($data)
    {
        //格式化部分字段
        $data['updatetime'] = strtotime($data['updatetime']);
        if (is_array($data['position'])) {
            $position = '';
            foreach ($data['position'] as $value) {
                $position .= $value . ',';
            }
            $data['position'] = substr($position, 0, -1);
        }
        if (empty($data['position'])) {
            $data['position'] = '';
        }
        $data['urltitle'] = $this->get_urltitle($data['title'], $data['urltitle']);
        //录入数据
        $aid = $this->model->table('content')->data($data)->insert(); //录入基本信息
        model('tags')->content_save($data['keywords'], $aid); //处理TAG
        model('position')->add_content_save($data['position'], $aid); //保存广告位
        model('expand_model')->add_content_save($data, $aid); //录入扩展模型数据
        model('upload')->relation('content', $data['file_id'], $aid); //录入附件表
        /*hook*/
        $this->plus_hook('content', 'add_data', $data);
        /*hook end*/
        return $aid;
    }

    //内容表信息
    public function add_content_save($data)
    {
        $data['content'] = html_in($data['content']);
        return $this->model->table('content_data')->data($data)->insert();
    }

    //获取内容基本信息
    public function info($aid)
    {
        return $this->model->table('content')->where('aid=' . $aid)->find();
    }

    //获取附加内容
    public function info_content($aid)
    {
        return $this->model->table('content_data')->where('aid=' . $aid)->find();
    }

    //基础表信息
    public function edit_save($data, $ext = true)
    {
        //格式化部分字段
        $data['updatetime'] = strtotime($data['updatetime']);
        if (is_array($data['position'])) {
            $position = '';
            foreach ($data['position'] as $value) {
                $position .= $value . ',';
            }
            $data['position'] = substr($position, 0, -1);
        }
        if (empty($data['position'])) {
            $data['position'] = '';
        }
        $data['urltitle'] = $this->get_urltitle($data['title'], $data['urltitle'], $data['aid']);
        //录入数据
        $aid = $this->model->table('content')->data($data)->where('aid=' . $data['aid'])->update(); //录入基本信息
        model('tags')->content_save($data['keywords'], $data['aid']); //处理TAG
        model('position')->edit_content_save($data['position'], $data['aid']); //保存广告位
        if ($ext) {
            model('expand_model')->edit_content_save($data); //录入扩展模型数据
        }
        model('upload')->relation('content', $data['file_id'], $data['aid']); //录入附件表
        /*hook*/
        $this->plus_hook('content', 'edit_data', $data);
        /*hook end*/
        return $aid;
    }

    //内容表信息
    public function edit_content_save($data)
    {
        $data['content'] = html_in($data['content']);
        return $this->model->table('content_data')->data($data)->where('aid=' . $data['aid'])->update();
    }

    //获取内容ID列表
    public function get_list_id($cid)
    {
        return $this->model->table('content')->field('aid')->where('cid=' . $cid)->select();
    }

    //内容删除
    public function del($aid)
    {
        /*hook*/
        $this->plus_hook('content', 'del_data', $aid);
        /*hook end*/

        //删除内容基本信息
        model('expand_model')->del_content($aid);
        $status = $this->model->table('content')->where('aid=' . $aid)->delete();
        model('position')->del_content($aid);
        model('tags')->del_content($aid);
        model('upload')->del_file('content', $aid);
        return $status;
    }

    public function del_content($aid)
    {
        return $this->model->table('content_data')->where('aid=' . $aid)->delete();
    }

    //审核草稿
    public function status($aid, $status)
    {
        $where['status'] = intval($status);
        return $this->model->table('content')->data($where)->where('aid=' . $aid)->update();
    }

    //修改栏目ID
    public function edit_cid($aid, $cid)
    {
        $where['cid'] = intval($cid);
        return $this->model->table('content')->data($where)->where('aid=' . $aid)->update();
    }

    //获取标题拼音
    public function get_urltitle($name = '', $urlname = null, $aid = null)
    {
        if (empty($name)) {
            return false;
            exit;
        }
        if (empty($urlname)) {
            $pinyin = new Pinyin();
            $pattern = '/[^\x{4e00}-\x{9fa5}\d\w]+/u';
            $name = preg_replace($pattern, '', $name);
            $urlname = substr($pinyin->output($name, true), 0, 30);
        }

        $where = '';
        if (!empty($aid)) {
            $where = 'AND aid<>' . $aid;
        }

        $info = $this->model->table('content')->where("urltitle='" . $urlname . "'" . $where)->count();

        if (empty($info)) {
            return $urlname;
        } else {
            return $urlname . substr(cp_uniqid(), 8);
        }
    }

    //获取关键词
    public function get_keyword($title, $content)
    {
        $data = Http::doGet('http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title=' . urlencode($title) . '&content=' . urlencode($content), 10);
        if (empty($data)) {
            return;
        }
        preg_match_all("/<kw>(.*)A\[(.*)\]\](.*)><\/kw>/", $data, $list, PREG_SET_ORDER);

        if (empty($list)) {
            return;
        }

        $keywords = '';
        foreach ($list as $value) {
            $keywords .= $value[2] . ',';
        }
        return substr($keywords, 0, -1);


    }


}

?>