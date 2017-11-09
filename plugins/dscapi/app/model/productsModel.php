<?php

namespace app\model;

abstract class productsModel extends \app\func\common {

    public function productsModel($table = '') {
        
    }

    public function get_where($val = array(), $alias = '') {
        $where = 1;
        $where .= \app\func\base::get_where($val['product_id'], $alias . 'product_id');
        $where .= \app\func\base::get_where($val['goods_id'], $alias . 'goods_id');
        $where .= \app\func\base::get_where($val['goods_attr'], $alias . 'goods_attr');
        $where .= \app\func\base::get_where($val['product_sn'], $alias . 'product_sn');

        $where .= \app\func\base::get_where($val['bar_code'], $alias . 'bar_code');
        $where .= \app\func\base::get_where($val['product_number'], $alias . 'product_number');
        $where .= \app\func\base::get_where($val['product_price'], $alias . 'product_price');
        $where .= \app\func\base::get_where($val['product_number'], $alias . 'product_number');
        $where .= \app\func\base::get_where($val['product_market_price'], $alias . 'product_market_price');
        $where .= \app\func\base::get_where($val['product_warn_number'], $alias . 'product_warn_number');
        return $where;
    }

    public function get_insert($table, $select, $format) {
        $productsLang = \languages\productsLang::lang_products_insert();
        $GLOBALS['db']->autoExecute($GLOBALS['ecs']->table($table), $select, 'INSERT');
        $id = $GLOBALS['db']->insert_id();
        $common_data = array('result' => empty($id) ? 'failure' : 'success', 'id' => $id, 'msg' => empty($id) ? $goodsLang['msg_failure']['failure'] : $goodsLang['msg_success']['success'], 'error' => empty($id) ? $goodsLang['msg_failure']['error'] : $goodsLang['msg_success']['error'], 'format' => $format);
        \app\func\common::common($common_data);
        return \app\func\common::data_back();
    }

}
