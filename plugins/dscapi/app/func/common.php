<?php

namespace app\func;

class common {

    static private $format = 'json';
    static private $page_size = 10;
    static private $page = 1;
    static private $charset = 'utf-8';
    static private $result;
    static private $msg;
    static private $error;
    static private $allowOutputType = array('xml' => 'application/xml', 'json' => 'application/json', 'html' => 'text/html');
    static private $id;

    public function __construct($data = array()) {
        self::common($data);
    }

    static public function common($data = array()) {
        self::$format = (isset($data['format']) ? $data['format'] : 'josn');
        self::$page_size = (isset($data['page_size']) ? $data['page_size'] : 10);
        self::$page = (isset($data['page']) ? $data['page'] : 1);
        self::$msg = (isset($data['msg']) ? $data['msg'] : '');
        self::$result = (isset($data['result']) ? $data['result'] : 'success');
        self::$error = (isset($data['error']) ? $data['error'] : 0);
        self::$id = (isset($data['id']) ? $data['id'] : 0);
    }

    static public function data_back($info = array(), $arr_type = 0) {
        if ($arr_type == 1) {
            $list = self::page_array(self::$page_size, self::$page, $info);
            $info = $list;
        }

        $data_arr = array('result' => self::$result, 'id' => self::$id, 'error' => self::$error, 'msg' => self::$msg);

        if ($info) {
            $data_arr['info'] = $info;
        }

        $data_arr = self::to_utf8_iconv($data_arr);

        if (self::$format == 'xml') {
            if (isset(self::$allowOutputType[self::$format])) {
                header('Content-Type: ' . self::$allowOutputType[self::$format] . '; charset=' . self::$charset);
            }

            return self::xml_encode($data_arr);
        } else {
            if (isset(self::$allowOutputType[self::$format])) {
                header('Content-Type: ' . self::$allowOutputType[self::$format] . '; charset=' . self::$charset);
            }

            return json_encode($data_arr);
        }
    }

    static public function xml_encode($data, $root = 'dsc', $item = 'item', $attr = '', $id = 'id', $encoding = 'utf-8') {
        if (is_array($attr)) {
            $_attr = array();

            foreach ($attr as $key => $value) {
                $_attr[] = $key . '="' . $value . '"';
            }

            $attr = implode(' ', $_attr);
        }

        $attr = trim($attr);
        $attr = (empty($attr) ? '' : ' ' . $attr);
        $xml = '<?xml version="1.0" encoding="' . $encoding . '"?>';
        $xml .= '<' . $root . $attr . '>';
        $xml .= self::data_to_xml($data, $item, $id);
        $xml .= '</' . $root . '>';
        return $xml;
    }

    static public function data_to_xml($data, $item = 'item', $id = 'id') {
        $xml = $attr = '';

        foreach ($data as $key => $val) {
            if (is_numeric($key)) {
                $id && ($attr = ' ' . $id . '="' . $key . '"');
                $key = $item;
            }

            $xml .= '<' . $key . $attr . '>';
            $xml .= (is_array($val) || is_object($val) ? self::data_to_xml($val, $item, $id) : $val);
            $xml .= '</' . $key . '>';
        }

        return $xml;
    }

    static public function to_utf8_iconv($str) {
        if (EC_CHARSET != 'utf-8') {
            if (is_string($str)) {
                return ecs_iconv(EC_CHARSET, 'utf-8', $str);
            } else if (is_array($str)) {
                foreach ($str as $key => $value) {
                    $str[$key] = to_utf8_iconv($value);
                }

                return $str;
            } else if (is_object($str)) {
                foreach ($str as $key => $value) {
                    $str->$key = to_utf8_iconv($value);
                }

                return $str;
            } else {
                return $str;
            }
        }

        return $str;
    }

    static public function page_array($page_size = 1, $page = 1, $array = array(), $order = 0) {
        $arr = array();
        $pagedata = array();

        if ($array) {
            global $countpage;
            $start = ($page - 1) * $page_size;

            if ($order == 1) {
                $array = array_reverse($array);
            }

            if (isset($array['record_count'])) {
                $totals = $array['record_count'];
                $countpage = ceil($totals / $page_size);
                $pagedata = $array['list'];
            } else {
                $totals = count($array);
                $countpage = ceil($totals / $page_size);
                $pagedata = array_slice($array, $start, $page_size);
            }

            $filter = array('page' => $page, 'page_size' => $page_size, 'record_count' => $totals, 'page_count' => $countpage);
            $arr = array('list' => $pagedata, 'filter' => $filter, 'page_count' => $countpage, 'record_count' => $totals);
        }

        return $arr;
    }

    static public function get_reference_only($table, $where = 1, $select = '', $type = 0) {
        if (!empty($select) && is_array($select)) {
            $select = implode(',', $select);
        } else {
            $select = '*';
        }

        $sql = 'SELECT ' . $select . ' FROM ' . $GLOBALS['ecs']->table($table) . ' WHERE ' . $where;

        if ($type == 1) {
            return $GLOBALS['db']->getRow($sql);
        } else {
            return $GLOBALS['db']->getOne($sql);
        }
    }

    static public function get_image_post() {
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

    public function __callStatic($method, $arguments) {
        return call_user_func_array(array(self, $method), $arguments);
    }

}

?>
