<?php

$seller_type = (isset($_REQUEST['seller_type']) ? $base->get_intval($_REQUEST['seller_type']) : -1);
$seller_id = (isset($_REQUEST['seller_id']) ? $base->get_intval($_REQUEST['seller_id']) : -1);
$cat_id = (isset($_REQUEST['cat_id']) ? $base->get_intval($_REQUEST['cat_id']) : -1);
$user_cat = (isset($_REQUEST['user_cat']) ? $base->get_intval($_REQUEST['user_cat']) : -1);
$goods_id = (isset($_REQUEST['goods_id']) ? $base->get_intval($_REQUEST['goods_id']) : -1);
$brand_id = (isset($_REQUEST['brand_id']) ? $base->get_intval($_REQUEST['brand_id']) : -1);
$goods_sn = (isset($_REQUEST['goods_sn']) ? $base->get_addslashes($_REQUEST['goods_sn']) : -1);
$bar_code = (isset($_REQUEST['bar_code']) ? $base->get_addslashes($_REQUEST['bar_code']) : -1);
$w_id = (isset($_REQUEST['w_id']) ? $base->get_intval($_REQUEST['w_id']) : -1);
$a_id = (isset($_REQUEST['a_id']) ? $base->get_intval($_REQUEST['a_id']) : -1);
$region_id = (isset($_REQUEST['region_id']) ? $base->get_intval($_REQUEST['region_id']) : -1);
$region_sn = (isset($_REQUEST['region_sn']) ? $base->get_addslashes($_REQUEST['region_sn']) : -1);
$img_id = (isset($_REQUEST['img_id']) ? $base->get_intval($_REQUEST['img_id']) : -1);
$attr_id = (isset($_REQUEST['attr_id']) ? $base->get_intval($_REQUEST['attr_id']) : -1);
$goods_attr_id = (isset($_REQUEST['goods_attr_id']) ? $base->get_intval($_REQUEST['goods_attr_id']) : -1);
$tid = (isset($_REQUEST['tid']) ? $base->get_addslashes($_REQUEST['tid']) : -1);
$val = array('seller_type' => $seller_type, 'seller_id' => $seller_id, 'brand_id' => $brand_id, 'cat_id' => $cat_id, 'user_cat' => $user_cat, 'goods_id' => $goods_id, 'goods_sn' => $goods_sn, 'bar_code' => $bar_code, 'w_id' => $w_id, 'a_id' => $a_id, 'region_id' => $region_id, 'region_sn' => $region_sn, 'img_id' => $img_id, 'attr_id' => $attr_id, 'goods_attr_id' => $goods_attr_id, 'tid' => $tid, 'goods_select' => $data, 'page_size' => $page_size, 'page' => $page, 'sort_by' => $sort_by, 'sort_order' => $sort_order, 'format' => $format);
$goods = new \app\controller\goods($val);

switch ($method) {
    case 'dsc.goods.list.get':
        $table = array('goods' => 'goods');
        $goods_list = $goods->get_goods_list($table);
        exit($goods_list);
        break;

    case 'dsc.goods.info.get':
        $table = array('goods' => 'goods');
        $goods_info = $goods->get_goods_info($table);
        exit($goods_info);
        break;

    case 'dsc.goods.insert.post':
        $table = array('goods' => 'goods');
        $result = $goods->get_goods_insert($table);
        exit($result);
        break;

    case 'dsc.goods.update.post':
        $table = array('goods' => 'goods');
        $result = $goods->get_goods_update($table);
        exit($result);
        break;

    case 'dsc.goods.del.post':
        $table = array('goods' => 'goods');
        $result = $goods->get_goods_delete($table);
        exit($result);
        break;

    case 'dsc.goods.warehouse.list.get':
        $table = array('warehouse' => 'warehouse_goods');
        $result = $goods->get_goods_warehouse_list($table);
        exit($result);
        break;

    case 'dsc.goods.warehouse.info.get':
        $table = array('warehouse' => 'warehouse_goods');
        $result = $goods->get_goods_warehouse_info($table);
        exit($result);
        break;

    case 'dsc.goods.warehouse.insert.post':
        $table = array('warehouse' => 'warehouse_goods');
        $result = $goods->get_goods_warehouse_insert($table);
        exit($result);
        break;

    case 'dsc.goods.warehouse.update.post':
        $table = array('warehouse' => 'warehouse_goods');
        $result = $goods->get_goods_warehouse_update($table);
        exit($result);
        break;

    case 'dsc.goods.warehouse.del.post':
        $table = array('warehouse' => 'warehouse_goods');
        $result = $goods->get_goods_warehouse_delete($table);
        exit($result);
        break;

    case 'dsc.goods.area.list.get':
        $table = array('area' => 'warehouse_area_goods');
        $result = $goods->get_goods_area_list($table);
        exit($result);
        break;

    case 'dsc.goods.area.info.get':
        $table = array('area' => 'warehouse_area_goods');
        $result = $goods->get_goods_area_info($table);
        exit($result);
        break;

    case 'dsc.goods.area.insert.post':
        $table = array('area' => 'warehouse_area_goods');
        $result = $goods->get_goods_area_insert($table);
        exit($result);
        break;

    case 'dsc.goods.area.update.post':
        $table = array('area' => 'warehouse_area_goods');
        $result = $goods->get_goods_area_update($table);
        exit($result);
        break;

    case 'dsc.goods.area.del.post':
        $table = array('area' => 'warehouse_area_goods');
        $result = $goods->get_goods_area_delete($table);
        exit($result);
        break;

    case 'dsc.goods.gallery.list.get':
        $table = array('gallery' => 'goods_gallery');
        $result = $goods->get_goods_gallery_list($table);
        exit($result);
        break;

    case 'dsc.goods.gallery.info.get':
        $table = array('gallery' => 'goods_gallery');
        $result = $goods->get_goods_gallery_info($table);
        exit($result);
        break;

    case 'dsc.goods.gallery.insert.post':
        $table = array('gallery' => 'goods_gallery');
        $result = $goods->get_goods_gallery_insert($table);
        exit($result);
        break;

    case 'dsc.goods.gallery.update.post':
        $table = array('gallery' => 'goods_gallery');
        $result = $goods->get_goods_gallery_update($table);
        exit($result);
        break;

    case 'dsc.goods.gallery.del.post':
        $table = array('gallery' => 'goods_gallery');
        $result = $goods->get_goods_gallery_delete($table);
        exit($result);
        break;

    case 'dsc.goods.attr.list.get':
        $table = array('attr' => 'goods_attr');
        $result = $goods->get_goods_attr_list($table);
        exit($result);
        break;

    case 'dsc.goods.attr.info.get':
        $table = array('attr' => 'goods_attr');
        $result = $goods->get_goods_attr_info($table);
        exit($result);
        break;

    case 'dsc.goods.attr.insert.post':
        $table = array('attr' => 'goods_attr');
        $result = $goods->get_goods_attr_insert($table);
        exit($result);
        break;

    case 'dsc.goods.attr.update.post':
        $table = array('attr' => 'goods_attr');
        $result = $goods->get_goods_attr_update($table);
        exit($result);
        break;

    case 'dsc.goods.attr.del.post':
        $table = array('attr' => 'goods_attr');
        $result = $goods->get_goods_attr_delete($table);
        exit($result);
        break;

    case 'dsc.goods.freight.list.get':
        $table = array(
            array('table' => 'goods_transport', 'alias' => 'gt'),
            array('table' => 'goods_transport_extend', 'alias' => 'gted'),
            array('table' => 'goods_transport_express', 'alias' => 'gtes')
        );
        $result = $goods->get_goods_freight_list($table);
        exit($result);
        break;

    case 'dsc.goods.freight.info.get':
        $table = array(
            array('table' => 'goods_transport', 'alias' => 'gt'),
            array('table' => 'goods_transport_extend', 'alias' => 'gted'),
            array('table' => 'goods_transport_express', 'alias' => 'gtes')
        );
        $result = $goods->get_goods_freight_info($table);
        exit($result);
        break;

    case 'dsc.goods.freight.insert.post':
        $table = array('goods_transport', 'goods_transport_extend', 'goods_transport_express');
        $result = $goods->get_goods_freight_insert($table);
        exit($result);
        break;

    case 'dsc.goods.freight.update.post':
        $table = array('goods_transport', 'goods_transport_extend', 'goods_transport_express');
        $result = $goods->get_goods_freight_update($table);
        exit($result);
        break;

    case 'dsc.goods.freight.del.post':
        $table = array('goods_transport', 'goods_transport_extend', 'goods_transport_express');
        $result = $goods->get_goods_freight_delete($table);
        exit($result);
        break;
    case 'dsc.goods.image.insert.post':
        $image = new \app\controller\image($_CFG['bgcolor']);
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
//                get_del_edit_goods_img($goods_id);
                $db->autoExecute($ecs->table('goods'), $result['data'], 'UPDATE', 'goods_id = \'' . $goods_id . '\'');
            }

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
        }
        if ($upload_status) {
            $result['error'] = 0;
            $result['pic'] = $pic_url;
            $result['name'] = $pic_name;
        } else {
            $result['error'] = '上传有误，清检查服务器配置！';
        }
        exit(json_encode($result));
        break;
    default:
        echo '非法接口连接';
        break;
}
