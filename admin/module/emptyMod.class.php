<?php
//插件模块，用于显示插件
class emptyMod extends commonMod
{

    public function _empty()
    {
        $action_name = $_GET['_action'];

        if (empty($info)) {
            cpError::show($_GET['_module'] . '模块或插件不存在');
        } else {
            if ($info['status'] == 1) {
            } else {
                cpError::show($_GET['_module'] . '模块或插件不存在');
            }

        }


    }

}

?>