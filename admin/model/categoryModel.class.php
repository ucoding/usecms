<?php
class categoryModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取栏目树形列表
    public function category_list($id = 0)
    {
        $lang = model('lang')->current_lang();
        $data = $this->model->field('A.*,B.model,B.name as mname,B.admin_category,B.admin_content')
            ->table('category', 'A')
            ->add_table('model', 'B', 'A.mid = B.mid')
            ->where('A.lang=' . $lang['id'])
            ->order('A.sequence DESC,A.cid ASC')
            ->select();

        $cat = new Category(array('cid', 'pid', 'name', 'cname'));
        return $cat->getTree($data, $id);
    }

    //获取子栏目统计
    public function list_count($pid)
    {
        return $this->model->table('category')->where('pid=' . $pid)->count();
    }

    //获取所有栏目统计
    public function category_count()
    {
        return $this->model->table('category')->count();
    }

    //获取栏目基本信息
    public function info($id)
    {
        return $this->model->table('category')->where('cid=' . $id)->find();
    }

    //栏目保存
    public function add_save($data)
    {
        //转换拼音栏目
        $data['urlname'] = $this->get_urlname($data['name'], $data['urlname']);
        //获取语言信息
        $lang = model('lang')->current_lang();
        $data['lang'] = $lang['id'];
        $data['seo_content'] = html_in($data['seo_content']);
        $cid = $this->model->table('category')->data($data)->insert();
        //录入附件表
        model('upload')->relation('category', $data['file_id'], $cid);

        /*hook*/
        $this->plus_hook('category', 'add_data', $data);
        /*hook end*/
        return $cid;
    }

    //栏目保存
    public function edit_save($data)
    {
        $cid = intval($data['cid']);
        //转换拼音栏目
        $data['urlname'] = $this->get_urlname($data['name'], $data['urlname'], $cid);
        $data['seo_content'] = html_in($data['seo_content']);
        $status = $this->model->table('category')->data($data)->where('cid=' . $cid)->update();
        //录入附件表
        model('upload')->relation('category', $data['file_id'], $cid);
        /*hook*/
        $this->plus_hook('category', 'edit_data', $data);
        /*hook end*/
        return $status;
    }

    //栏目删除
    public function del($cid)
    {
        /*hook*/
        $this->plus_hook('category', 'del_data', $cid);
        /*hook end*/
        $status = $this->model->table('category')->where('cid=' . $cid)->delete();
        model('upload')->del_file('category', $cid);
        return $status;
    }

    //获取栏目拼音
    public function get_urlname($name = '', $urlname = null, $cid = null)
    {
        if (empty($name)) {
            return false;
            exit;
        }
        if (empty($urlname)) {
            $pinyin = new Pinyin();
            $pattern = '/[^\x{4e00}-\x{9fa5}\d\w]+/u';
            $name = preg_replace($pattern, '', $name);
            $urlname = substr($pinyin->output($name, true), 0, 50);
        }

        $where = '';
        if (!empty($cid)) {
            $where = 'AND cid<>' . $cid;
        }

        $info = $this->model->table('category')->where("urlname='" . $urlname . "'" . $where)->count();

        if (empty($info)) {
            return $urlname;
        } else {
            return $urlname . substr(cp_uniqid(), 8);
        }
    }

    //获取模板列表
    public function tpl_list()
    {
        require(__ROOTDIR__ . '/inc/config.php');
        if ($config['LANG_OPEN']) {
            $lang = __LANG__ . '/';
        }
        $tpl_dir = __ROOTDIR__ . '/' . $config['TPL_TEMPLATE_PATH'] . $lang;

        $list_file = glob($tpl_dir . '*.php');
        if (is_array($list_file)) {
            foreach ($list_file as $value) {
                $array = explode('/', $value);
                $list[] = end($array);
            }
        }
        return $list;
    }


    public function sequence($cid, $sequence)
    {
        $data['sequence'] = $sequence;
        return $this->model->table('category')->data($data)->where('cid=' . $cid)->update();

    }

}

?>