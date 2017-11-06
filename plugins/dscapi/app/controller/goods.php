<?php

namespace app\controller;

class goods extends \app\model\goodsModel {

    private $table;
    private $alias;
    private $goods_select = array();
    private $select;
    private $seller_id = 0;
    private $brand_id = 0;
    private $cat_id = 0;
    private $user_cat = 0;
    private $goods_id = 0;
    private $goods_sn = '';
    private $bar_code = '';
    private $w_id = 0;
    private $a_id = 0;
    private $region_id = 0;
    private $region_sn = '';
    private $img_id = 0;
    private $attr_id = 0;
    private $goods_attr_id = 0;
    private $tid = '';
    private $seller_type = 0;
    private $format = 'json';
    private $page_size = 10;
    private $page = 1;
    private $wehre_val;
    private $goodsLangList;
    private $sort_by;
    private $sort_order;

    public function __construct($where = array()) {
        $this->goods($where);
        $this->wehre_val = array('seller_id' => $this->seller_id, 'brand_id' => $this->brand_id, 'cat_id' => $this->cat_id, 'user_cat' => $this->user_cat, 'goods_id' => $this->goods_id, 'goods_sn' => $this->goods_sn, 'bar_code' => $this->bar_code, 'w_id' => $this->w_id, 'a_id' => $this->a_id, 'region_id' => $this->region_id, 'region_sn' => $this->region_sn, 'img_id' => $this->img_id, 'attr_id' => $this->attr_id, 'goods_attr_id' => $this->goods_attr_id, 'tid' => $this->tid, 'seller_type' => $this->seller_type);
        $this->where = \app\model\goodsModel::get_where($this->wehre_val);
        $this->select = \app\func\base::get_select_field($this->goods_select);
    }

    public function goods($where = array()) {
        $this->seller_type = $where['seller_type'];
        $this->table = $where['table'];
        $this->seller_id = $where['seller_id'];
        $this->brand_id = $where['brand_id'];
        $this->cat_id = $where['cat_id'];
        $this->user_cat = $where['user_cat'];
        $this->goods_id = $where['goods_id'];
        $this->goods_sn = $where['goods_sn'];
        $this->bar_code = $where['bar_code'];
        $this->w_id = $where['w_id'];
        $this->a_id = $where['a_id'];
        $this->region_id = $where['region_id'];
        $this->region_sn = $where['region_sn'];
        $this->img_id = $where['img_id'];
        $this->attr_id = $where['attr_id'];
        $this->goods_attr_id = $where['goods_attr_id'];
        $this->tid = $where['tid'];
        $this->goods_select = $where['goods_select'];
        $this->format = $where['format'];
        $this->page_size = $where['page_size'];
        $this->page = $where['page'];
        $this->sort_by = $where['sort_by'];
        $this->sort_order = $where['sort_order'];
        $this->goodsLangList = \languages\goodsLang::lang_goods_request();
    }

    public function get_goods_list($table) {
        $this->table = $table['goods'];
        $result = \app\model\goodsModel::get_select_list($this->table, $this->select, $this->where, $this->page_size, $this->page, $this->sort_by, $this->sort_order);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_info($table) {
        $this->table = $table['goods'];
        $result = \app\model\goodsModel::get_select_info($this->table, $this->select, $this->where);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_insert($table) {
        $this->table = $table['goods'];
        return \app\model\goodsModel::get_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_update($table) {
        $this->table = $table['goods'];
        return \app\model\goodsModel::get_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_delete($table) {
        $this->table = $table['goods'];
        return \app\model\goodsModel::get_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_warehouse_list($table) {
        $this->table = $table['warehouse'];
        $result = \app\model\goodsModel::get_select_list($this->table, $this->select, $this->where, $this->page_size, $this->page, $this->sort_by, $this->sort_order);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_warehouse_info($table) {
        $this->table = $table['warehouse'];
        $result = \app\model\goodsModel::get_select_info($this->table, $this->select, $this->where);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_warehouse_insert($table) {
        $this->table = $table['warehouse'];
        return \app\model\goodsModel::get_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_warehouse_update($table) {
        $this->table = $table['warehouse'];
        return \app\model\goodsModel::get_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_warehouse_delete($table) {
        $this->table = $table['warehouse'];
        return \app\model\goodsModel::get_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_area_list($table) {
        $this->table = $table['area'];
        $result = \app\model\goodsModel::get_select_list($this->table, $this->select, $this->where, $this->page_size, $this->page, $this->sort_by, $this->sort_order);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_area_info($table) {
        $this->table = $table['area'];
        $result = \app\model\goodsModel::get_select_info($this->table, $this->select, $this->where);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_area_insert($table) {
        $this->table = $table['area'];
        return \app\model\goodsModel::get_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_area_update($table) {
        $this->table = $table['area'];
        return \app\model\goodsModel::get_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_area_delete($table) {
        $this->table = $table['area'];
        return \app\model\goodsModel::get_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_gallery_list($table) {
        $this->table = $table['gallery'];
        $result = \app\model\goodsModel::get_select_list($this->table, $this->select, $this->where, $this->page_size, $this->page, $this->sort_by, $this->sort_order);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_gallery_info($table) {
        $this->table = $table['gallery'];
        $result = \app\model\goodsModel::get_select_info($this->table, $this->select, $this->where);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_gallery_insert($table) {
        $this->table = $table['gallery'];
        return \app\model\goodsModel::get_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_gallery_update($table) {
        $this->table = $table['gallery'];
        return \app\model\goodsModel::get_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_gallery_delete($table) {
        $this->table = $table['gallery'];
        return \app\model\goodsModel::get_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_attr_list($table) {
        $this->table = $table['attr'];
        $result = \app\model\goodsModel::get_select_list($this->table, $this->select, $this->where, $this->page_size, $this->page, $this->sort_by, $this->sort_order);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_attr_info($table) {
        $this->table = $table['attr'];
        $result = \app\model\goodsModel::get_select_info($this->table, $this->select, $this->where);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_attr_insert($table) {
        $this->table = $table['attr'];
        return \app\model\goodsModel::get_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_attr_update($table) {
        $this->table = $table['attr'];
        return \app\model\goodsModel::get_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_attr_delete($table) {
        $this->table = $table['attr'];
        return \app\model\goodsModel::get_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_freight_list($table) {
        if ($this->seller_id != -1) {
            $this->where = 'gt.ru_id = ' . $this->seller_id . ' GROUP BY gt.tid';
        }

        $join_on = array('', 'tid|tid', 'tid|tid');
        $this->table = $table;
        $result = \app\model\goodsModel::get_join_select_list($this->table, $this->select, $this->where, $join_on);
        $result = \app\model\goodsModel::get_list_common_data($result, $this->page_size, $this->page, $this->goodsLangList, $this->format);
        return $result;
    }

    public function get_goods_freight_info($table) {
        if ($this->tid != -1) {
            $this->where = 'gt.tid = ' . $this->tid . ' GROUP BY gt.tid';
        }

        $join_on = array('', 'tid|tid', 'tid|tid');
        $this->table = $table;
        $result = \app\model\goodsModel::get_join_select_info($this->table, $this->select, $this->where, $join_on);

        if (strlen($this->where) != 1) {
            $result = \app\model\goodsModel::get_info_common_data_fs($result, $this->goodsLangList, $this->format);
        } else {
            $result = \app\model\goodsModel::get_info_common_data_f($this->goodsLangList, $this->format);
        }

        return $result;
    }

    public function get_goods_freight_insert($table) {
        $this->table = $table;
        return \app\model\goodsModel::get_more_insert($this->table, $this->goods_select, $this->format);
    }

    public function get_goods_freight_update($table) {
        $this->table = $table;
        return \app\model\goodsModel::get_more_update($this->table, $this->goods_select, $this->where, $this->format);
    }

    public function get_goods_freight_delete($table) {
        $this->table = $table;
        return \app\model\goodsModel::get_more_delete($this->table, $this->where, $this->format);
    }

    public function get_goods_image_post() {
        include_once '/includes/cls_image.php';
        $image = new cls_image($_CFG['bgcolor']);
        require_once ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php';
        $act_type = (empty($_REQUEST['type']) ? '' : trim($_REQUEST['type']));
        $id = (empty($_REQUEST['id']) ? 0 : intval($_REQUEST['id']));
        $result = array('error' => 0, 'pic' => '', 'name' => '');
        $typeArr = array('jpg', 'png', 'gif', 'jpeg');
        $http = $GLOBALS['ecs']->http();

        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];

            if (empty($name)) {
                $result['error'] = '您还未选择图片！';
            }

            $type = strtolower(substr(strrchr($name, '.'), 1));

            if (!in_array($type, $typeArr)) {
                $result['error'] = '清上传jpg,jpeg,png或gif类型的图片！';
            }
        }

        if ($act_type == 'goods_img') {
            $_FILES['goods_img'] = $_FILES['file'];
            $proc_thumb = (isset($GLOBALS['shop_id']) && (0 < $GLOBALS['shop_id']) ? false : true);
            $_POST['auto_thumb'] = 1;
            $_REQUEST['goods_id'] = $id;
            $goods_id = $id;
            $goods_img = '';
            $goods_thumb = '';
            $original_img = '';
            $old_original_img = '';
            if (($_FILES['goods_img']['tmp_name'] != '') && ($_FILES['goods_img']['tmp_name'] != 'none')) {
                if (empty($is_url_goods_img)) {
                    $original_img = $image->upload_image($_FILES['goods_img'], array('type' => 1));
                }

                $goods_img = $original_img;

                if ($_CFG['auto_generate_gallery']) {
                    $img = $original_img;
                    $pos = strpos(basename($img), '.');
                    $newname = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);
                    copy($img, $newname);
                    $img = $newname;
                    $gallery_img = $img;
                    $gallery_thumb = $img;
                }

                if (($proc_thumb && (0 < $image->gd_version()) && $image->check_img_function($_FILES['goods_img']['type'])) || $is_url_goods_img) {
                    if (empty($is_url_goods_img)) {
                        if (($_CFG['image_width'] != 0) || ($_CFG['image_height'] != 0)) {
                            $goods_img = $image->make_thumb(array('img' => $goods_img, 'type' => 1), $GLOBALS['_CFG']['image_width'], $GLOBALS['_CFG']['image_height']);
                        }

                        if ($_CFG['auto_generate_gallery']) {
                            $newname = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);
                            copy($img, $newname);
                            $gallery_img = $newname;
                        }

                        if ((0 < intval($_CFG['watermark_place'])) && !empty($GLOBALS['_CFG']['watermark'])) {
                            if ($image->add_watermark($goods_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
                                sys_msg($image->error_msg(), 1, array(), false);
                            }

                            if ($_CFG['auto_generate_gallery']) {
                                if ($image->add_watermark($gallery_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
                                    sys_msg($image->error_msg(), 1, array(), false);
                                }
                            }
                        }
                    }

                    if ($_CFG['auto_generate_gallery']) {
                        if (($_CFG['thumb_width'] != 0) || ($_CFG['thumb_height'] != 0)) {
                            $gallery_thumb = $image->make_thumb(array('img' => $img, 'type' => 1), $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);
                        }
                    }
                }
            }

            if (isset($_FILES['goods_thumb']) && ($_FILES['goods_thumb']['tmp_name'] != '') && isset($_FILES['goods_thumb']['tmp_name']) && ($_FILES['goods_thumb']['tmp_name'] != 'none')) {
                $goods_thumb = $image->upload_image($_FILES['goods_thumb'], array('type' => 1));
            } else {
                if ($proc_thumb && isset($_POST['auto_thumb']) && !empty($original_img)) {
                    if (($_CFG['thumb_width'] != 0) || ($_CFG['thumb_height'] != 0)) {
                        $goods_thumb = $image->make_thumb(array('img' => $original_img, 'type' => 1), $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);
                    } else {
                        $goods_thumb = $original_img;
                    }
                }
            }

            $original_img = reformat_image_name('goods', $goods_id, $original_img, 'source');
            $goods_img = reformat_image_name('goods', $goods_id, $goods_img, 'goods');
            $goods_thumb = reformat_image_name('goods_thumb', $goods_id, $goods_thumb, 'thumb');
            $result['data'] = array('original_img' => $original_img, 'goods_img' => $goods_img, 'goods_thumb' => $goods_thumb);

            if (empty($goods_id)) {
                $_SESSION['goods'][$admin_id][$goods_id] = $result['data'];
            } else {
                get_del_edit_goods_img($goods_id);
                $db->autoExecute($ecs->table('goods'), $result['data'], 'UPDATE', 'goods_id = \'' . $goods_id . '\'');
            }

            get_oss_add_file($result['data']);

            if ($img) {
                if (empty($is_url_goods_img)) {
                    $img = reformat_image_name('gallery', $goods_id, $img, 'source');
                    $gallery_img = reformat_image_name('gallery', $goods_id, $gallery_img, 'goods');
                } else {
                    $img = $url_goods_img;
                    $gallery_img = $url_goods_img;
                }

                $gallery_thumb = reformat_image_name('gallery_thumb', $goods_id, $gallery_thumb, 'thumb');
                $gallery_count = $GLOBALS['db']->getOne('SELECT MAX(img_desc) FROM ' . $GLOBALS['ecs']->table('goods_gallery') . ' WHERE goods_id = \'' . $goods_id . '\'');
                $img_desc = $gallery_count + 1;
                $sql = 'INSERT INTO ' . $ecs->table('goods_gallery') . ' (goods_id, img_url, img_desc, thumb_url, img_original) ' . 'VALUES (\'' . $goods_id . '\', \'' . $gallery_img . '\', ' . $img_desc . ', \'' . $gallery_thumb . '\', \'' . $img . '\')';
                $db->query($sql);
                $thumb_img_id[] = $GLOBALS['db']->insert_id();
                get_oss_add_file(array($gallery_img, $gallery_thumb, $img));

                if (!empty($_SESSION['thumb_img_id' . $_SESSION['admin_id']])) {
                    $_SESSION['thumb_img_id' . $_SESSION['admin_id']] = array_merge($thumb_img_id, $_SESSION['thumb_img_id' . $_SESSION['admin_id']]);
                } else {
                    $_SESSION['thumb_img_id' . $_SESSION['admin_id']] = $thumb_img_id;
                }

                $result['img_desc'] = $img_desc;
            }

            $pic_name = '';
            $goods_img = get_image_path($goods_id, $goods_img, true);
            $pic_url = $goods_img;
            $upload_status = 1;
        } else if ($act_type == 'gallery_img') {
            $_FILES['img_url'] = array(
                'name' => array($_FILES['file']['name']),
                'type' => array($_FILES['file']['type']),
                'tmp_name' => array($_FILES['file']['tmp_name']),
                'error' => array($_FILES['file']['error']),
                'size' => array($_FILES['file']['size'])
            );
            $_REQUEST['goods_id_img'] = $id;
            $_REQUEST['img_desc'] = array(
                array('')
            );
            $_REQUEST['img_file'] = array(
                array('')
            );
            $goods_id = (!empty($_REQUEST['goods_id_img']) ? intval($_REQUEST['goods_id_img']) : 0);
            $img_desc = (!empty($_REQUEST['img_desc']) ? $_REQUEST['img_desc'] : array());
            $img_file = (!empty($_REQUEST['img_file']) ? $_REQUEST['img_file'] : array());
            $php_maxsize = ini_get('upload_max_filesize');
            $htm_maxsize = '2M';

            if ($_FILES['img_url']) {
                foreach ($_FILES['img_url']['error'] as $key => $value) {
                    if ($value == 0) {
                        if (!$image->check_img_type($_FILES['img_url']['type'][$key])) {
                            $result['error'] = '1';
                            $result['massege'] = sprintf($_LANG['invalid_img_url'], $key + 1);
                        } else {
                            $goods_pre = 1;
                        }
                    } else if ($value == 1) {
                        $result['error'] = '1';
                        $result['massege'] = sprintf($_LANG['img_url_too_big'], $key + 1, $php_maxsize);
                    } else if ($_FILES['img_url']['error'] == 2) {
                        $result['error'] = '1';
                        $result['massege'] = sprintf($_LANG['img_url_too_big'], $key + 1, $htm_maxsize);
                    }
                }
            }

            $gallery_count = get_goods_gallery_count($goods_id);
            $result['img_desc'] = $gallery_count + 1;
            handle_gallery_image_add($goods_id, $_FILES['img_url'], $img_desc, $img_file, '', '', 'ajax', $result['img_desc']);
            clear_cache_files();

            if (0 < $goods_id) {
                $sql = 'SELECT * FROM ' . $ecs->table('goods_gallery') . ' WHERE goods_id = \'' . $goods_id . '\' ORDER BY img_desc ASC';
            } else {
                $img_id = $_SESSION['thumb_img_id' . $_SESSION['admin_id']];
                $where = '';

                if ($img_id) {
                    $where = 'AND img_id ' . db_create_in($img_id) . '';
                }

                $sql = 'SELECT * FROM ' . $ecs->table('goods_gallery') . ' WHERE goods_id=\'\' ' . $where . ' ORDER BY img_desc ASC';
            }

            $img_list = $db->getAll($sql);
            if (isset($GLOBALS['shop_id']) && (0 < $GLOBALS['shop_id'])) {
                foreach ($img_list as $key => $gallery_img) {
                    $gallery_img['img_original'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], true);
                    $img_list[$key]['img_url'] = $gallery_img['img_original'];
                    $gallery_img['thumb_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['thumb_url'], true);
                    $img_list[$key]['thumb_url'] = $gallery_img['thumb_url'];
                }
            } else {
                foreach ($img_list as $key => $gallery_img) {
                    $gallery_img['thumb_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['thumb_url'], true);
                    $img_list[$key]['thumb_url'] = $gallery_img['thumb_url'];
                }
            }

            $goods['goods_id'] = $goods_id;
            $smarty->assign('img_list', $img_list);
            $img_desc = array();

            foreach ($img_list as $k => $v) {
                $img_desc[] = $v['img_desc'];
            }

            $img_default = min($img_desc);
            $min_img_id = $db->getOne(' SELECT img_id   FROM ' . $ecs->table('goods_gallery') . ' WHERE goods_id = \'' . $goods_id . '\' AND img_desc = \'' . $img_default . '\' ORDER BY img_desc   LIMIT 1');
            $smarty->assign('goods', $goods);
            $this_img_info = $GLOBALS['db']->getRow(' SELECT * FROM ' . $GLOBALS['ecs']->table('goods_gallery') . ' WHERE goods_id = \'' . $goods_id . '\' ORDER BY img_id DESC LIMIT 1 ');
            $result['img_id'] = $this_img_info['img_id'];
            $result['min_img_id'] = $min_img_id;
            $pic_name = '';
            $this_img_info['thumb_url'] = get_image_path($goods_id, $this_img_info['thumb_url'], true);
            $pic_url = $this_img_info['thumb_url'];
            $upload_status = 1;
            $result['external_url'] = '';
        }

        if ($upload_status) {
            $result['error'] = 0;
            $result['pic'] = $pic_url;
            $result['name'] = $pic_name;
        } else {
            $result['error'] = '上传有误，清检查服务器配置！';
        }

        exit(json_encode($result));
    }

}
