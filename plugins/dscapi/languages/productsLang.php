<?php
namespace languages;
class productsLang {

    static private $lang_update_conf;
    static private $lang_insert_conf;

    public function __construct() {
        
    }

    static public function lang_products_request() {
        self::$lang_insert_conf = array(
            'msg_success' => array('success' => '成功获取数据', 'error' => 0),
            'msg_failure' => array('failure' => '数据为空值', 'error' => 1),
            'where_failure' => array('failure' => '条件为空', 'error' => 2)
        );
        return self::$lang_insert_conf;
    }

    static public function lang_products_insert() {
        self::$lang_insert_conf = array(
            'msg_success' => array('success' => '数据提交成功', 'error' => 0),
            'msg_failure' => array('failure' => '数据提交失败', 'error' => 1)
        );
        return self::$lang_insert_conf;
    }
}