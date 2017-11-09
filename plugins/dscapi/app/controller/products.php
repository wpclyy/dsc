<?php

namespace app\controller;

class products extends \app\model\productsModel {

    private $table;
    private $products_select;
    private $format;
    private $where_val;
    private $product_id;
    private $goods_id;
    private $goods_attr;
    private $product_sn;
    private $bar_code;
    private $product_number;
    private $product_price;
    private $product_market_price;
    private $product_warn_number;
    private $productsLangList;

    public function __construct($where = array()) {
        $this->products($where);
        $this->where_val = $val = array('product_id' => $product_id, 'goods_id' => $goods_id, 'goods_attr' => $goods_attr, 'product_sn' => $product_sn, 'bar_code' => $bar_code, 'product_number' => $product_number, 'product_price' => $product_price, 'product_market_price' => $product_market_price, 'product_warn_number' => $product_warn_number);
        $this->where = \app\model\productsModel::get_where($this->where_val);
        $this->select = \app\func\base::get_select_field($this->products_select);
    }

    public function products($where = array()) {
        $this->product_id = $where['product_id'];
        $this->goods_id = $where['goods_id'];
        $this->goods_attr = $where['goods_attr'];
        $this->product_sn = $where['product_sn'];
        $this->bar_code = $where['bar_code'];
        $this->product_number = $where['product_number'];
        $this->product_price = $where['product_price'];
        $this->product_market_price = $where['product_market_price'];
        $this->product_warn_number = $where['product_warn_number'];
        $this->products_select = $where["products_select"];
        $this->productsLangList = \languages\productsLang::lang_products_request();
    }

    public function get_products_insert($table) {
        $this->table = $table['products'];
        return \app\model\productsModel::get_insert($this->table, $this->products_select, $this->format);
    }

}
