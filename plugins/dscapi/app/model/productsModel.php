<?php

namespace app\model;

abstract class productsModel extends \app\func\common{
    
    public function productsModel($table='') {
        
    }
    
    public function get_insert($table,$select,$format) {
        $productsLang = \languages\productsLang::lang_products_insert();
        $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table($table), $select, 'INSERT');
        $id = $GLOBALS['db']->insert_id();
        $common_data = array('result' => empty($id) ? 'failure' : 'success', 'id' => $id, 'msg' => empty($id) ? $goodsLang['msg_failure']['failure'] : $goodsLang['msg_success']['success'], 'error' => empty($id) ? $goodsLang['msg_failure']['error'] : $goodsLang['msg_success']['error'], 'format' => $format);
        \app\func\common::common($common_data);
        return \app\func\common::data_back();
    }
}

