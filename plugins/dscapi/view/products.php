<?php

$product_id = (isset($_REQUEST["product_id"]) ? $base->get_intval($_REQUEST["product_id"]) : -1);
$goods_id = (isset($_REQUEST["goods_id"]) ? $base->get_intval($_REQUEST["goods_id"]) : -1);
$goods_attr = (isset($_REQUEST["goods_attr"]) ? $base->get_intval($_REQUEST["goods_attr"]) : -1);
$product_sn = (isset($_REQUEST["product_sn"]) ? $base->get_intval($_REQUEST["product_sn"]) : -1);
$bar_code = (isset($_REQUEST["bar_code"]) ? $base->get_intval($_REQUEST["bar_code"]) : -1);
$product_number = (isset($_REQUEST["product_number"]) ? $base->get_intval($_REQUEST["product_number"]) : -1);
$product_price = (isset($_REQUEST["product_price"]) ? $base->get_intval($_REQUEST["product_price"]) : -1);
$product_market_price = (isset($_REQUEST["product_market_price"]) ? $base->get_intval($_REQUEST["product_market_price"]) : -1);
$product_warn_number = (isset($_REQUEST["product_warn_number"]) ? $base->get_intval($_REQUEST["product_warn_number"]) : -1);
$val = array('product_id' => $product_id, 'goods_id' => $goods_id, 'goods_attr' => $goods_attr, 'product_sn' => $product_sn, 'bar_code' => $bar_code, 'product_number' => $product_number, 'product_price' => $product_price, 'product_market_price' => $product_market_price, 'product_warn_number' => $product_warn_number);
$products = new \app\controller\products($val);

switch ($method) {
    case'gdw.products.insert.post':
        $table = array('products'=>'products');
        $result = $products->get_products_insert($table);
        exit($result);
        break;
    case'gdw.products.update.post':
        $table = array('products'=>'products');
        break;
    default :
        echo '非法接口连接';
        break;
}