<?php
class menuModel extends commonModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //获取菜单
    public function admin_menu($pid = 0)
    {
        $user = model('user')->current_user();
        if (!empty($user['model_power']) && $user['keep'] <> 1) {
            $mod_where = ' AND id in(' . $user['model_power'] . ')';
        }
        return $this->model->table('admin_menu')->where('status=1 AND pid=' . $pid . $mod_where)->order('id asc')->select();
    }

    //获取菜单项目
    public function menu_list($pid = 0)
    {
        return $this->model->table('admin_menu')->where('pid=' . $pid)->order('id asc')->select();
    }

    //格式化内容菜单
    public function content_menu($gid = null)
    {
        $lang = model('lang')->current_lang();
        $data = $this->model->field('A.cid,A.pid,A.mid,A.type,A.name,B.admin_category,B.admin_content')
            ->table('category', 'A')
            ->add_table('model', 'B', 'A.mid = B.mid')
            ->where('A.lang=' . $lang['id'])
            ->order('A.sequence DESC,A.cid ASC')
            ->select();
        if (!empty($gid)) {
            $user = model('user')->current_user();
            if (!empty($user['class_power'])) {
                $class_power = explode(',', $user['class_power']);
            }
        }
        return $this->gentree($data, $class_power);
    }

    //检测模块
    public function module_menu($module)
    {
        return $this->model->table('admin_menu')->where('module="' . $module . '"')->find();
    }

    //输出数据
    public function gentree($data, $class_power = array())
    {
        if (empty($class_power)) {
            return $data;
        }
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $tree[$key] = $value;
                if (in_array($value['cid'], $class_power)) {
                    $tree[$key]['pw'] = 0;
                } else {
                    $tree[$key]['pw'] = 1;
                }
            }
        }
        return $tree;

    }

}

?>