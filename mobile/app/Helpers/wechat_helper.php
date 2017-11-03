<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
function get_wechat_image_path($image = '', $absolute_path = true, $is_mobile = true, $no_path = 'public/assets/wechat')
{
	$length = strlen($no_path);

	if (strtolower(substr($image, 0, $length)) == $no_path) {
		$url = ($absolute_path == true ? __HOST__ . '/' : '') . ($is_mobile == true ? ltrim(__ROOT__, '/') . '/' : '') . $image;
	}
	else {
		$image_url = get_image_path($image);

		if (strtolower(substr($image_url, 0, 4)) == 'http') {
			$url = $image_url;
		}
		else {
			$url = ($absolute_path == true ? __HOST__ : '') . $image_url;
		}
	}

	return $url;
}

function push_template($code = '', $content = array(), $url = '', $uid = 0)
{
	if (isset($_COOKIE['ectouch_ru_id'])) {
		$ru_id = $_COOKIE['ectouch_ru_id'];
		$where = array('ru_id' => $ru_id, 'status' => 1);
	}
	else {
		$where = array('default_wx' => 1, 'status' => 1);
	}

	$wechat_info = dao('wechat')->field('id, token, appid, appsecret')->where($where)->find();
	$config = array(
		'driver'       => 'wechat',
		'driverConfig' => array('token' => $wechat_info['token'], 'appid' => $wechat_info['appid'], 'appsecret' => $wechat_info['appsecret'])
		);
	$wechat = new \App\Notifications\Send($config);
	$data = array('url' => $url, 'wechat_id' => $wechat_info['id']);

	if ($uid == 0) {
		$uid = $_SESSION['user_id'];
	}

	if ($wechat->push($uid, $code, $content, $data) == true) {
		return true;
	}
	else {
		return $wechat->getError;
	}
}

function get_wechat_user_info($id = 0)
{
	if (is_wechat_browser() && is_dir(APP_WECHAT_PATH)) {
		$sql = 'SELECT u.user_name, u.nick_name, u.user_picture, wu.headimgurl, wu.nickname FROM ' . $GLOBALS['ecs']->table('users') . ' AS u ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('wechat_user') . ' AS wu ON wu.ect_uid = u.user_id ' . ' WHERE u.user_id = \'' . $id . '\' ';
	}
	else {
		$sql = 'SELECT user_name, nick_name , user_picture FROM ' . $GLOBALS['ecs']->table('users') . ' WHERE user_id = \'' . $id . '\' ';
	}

	$result = $GLOBALS['db']->getRow($sql);
	$user['nick_name'] = !empty($result['nickname']) ? $result['nickname'] : (!empty($result['nick_name']) ? $result['nick_name'] : $result['user_name']);
	$user['user_picture'] = !empty($result['headimgurl']) ? $result['headimgurl'] : $result['user_picture'];
	return $user;
}

function set_ru_id($ru_id)
{
	if (is_dir(APP_WECHAT_PATH)) {
		$cookiekey = 'ectouch_ru_id';

		if (0 < $ru_id) {
			cookie($cookiekey, $ru_id, gmtime() + (3600 * 24));
		}
		else {
			cookie($cookiekey, NULL);
		}
	}
}

function get_ru_id()
{
	if (is_dir(APP_WECHAT_PATH) && isset($_COOKIE['ectouch_ru_id'])) {
		$ru_id = $_COOKIE['ectouch_ru_id'];

		if ($GLOBALS['db']->getOne('SELECT ru_id FROM ' . $GLOBALS['ecs']->table('admin_user') . ' WHERE ru_id = \'' . $ru_id . '\' ')) {
			return $ru_id;
		}
		else {
			cookie($cookiekey, NULL);
		}
	}

	return 0;
}

function get_url_query($url = '')
{
	$info = parse_url($url);

	if (false == strpos($url, '?')) {
		if (isset($info['path'])) {
			parse_str($info['path'], $params);
		}
	}
	else if (isset($info['query'])) {
		parse_str($info['query'], $params);
	}

	return $params;
}

function get_connect_user($unionid)
{
	$sql = 'SELECT u.user_name, u.user_id, u.parent_id FROM {pre}users u, {pre}connect_user cu WHERE u.user_id = cu.user_id AND cu.open_id = \'' . $unionid . '\' ';
	$userinfo = $GLOBALS['db']->getRow($sql);
	return $userinfo;
}

function update_connnect_user($res, $type = '')
{
	$profile = array('nickname' => $res['nickname'], 'sex' => $res['sex'], 'province' => $res['province'], 'city' => $res['city'], 'country' => $res['country'], 'headimgurl' => $res['headimgurl']);
	$data = array('connect_code' => 'sns_' . $type, 'user_id' => $res['user_id'], 'open_id' => $res['unionid'], 'profile' => serialize($profile));
	if ((0 < $res['user_id']) && $res['unionid']) {
		$connect_userinfo = get_connect_user($res['unionid']);

		if (empty($connect_userinfo)) {
			$data['create_at'] = gmtime();
			dao('connect_user')->data($data)->add();
		}
		else {
			dao('connect_user')->data($data)->where(array('open_id' => $res['unionid']))->save();
		}
	}
}

function update_wechat_user($info, $is_relation = 0)
{
	$wechat_id = dao('wechat')->where(array('status' => 1, 'default_wx' => 1))->getField('id');
	$data = array('wechat_id' => $wechat_id, 'openid' => $info['openid'], 'nickname' => !empty($info['nickname']) ? $info['nickname'] : '', 'sex' => !empty($info['sex']) ? $info['sex'] : 0, 'language' => !empty($info['language']) ? $info['language'] : '', 'city' => !empty($info['city']) ? $info['city'] : '', 'province' => !empty($info['province']) ? $info['province'] : '', 'country' => !empty($info['country']) ? $info['country'] : '', 'headimgurl' => !empty($info['headimgurl']) ? $info['headimgurl'] : '', 'unionid' => $info['unionid'], 'ect_uid' => !empty($info['user_id']) ? $info['user_id'] : 0);

	if ($is_relation == 1) {
		unset($data['ect_uid']);
	}

	if (!empty($info['unionid'])) {
		$where = array('unionid' => $info['unionid'], 'wechat_id' => $wechat_id);
		$result = dao('wechat_user')->field('openid, unionid')->where($where)->find();

		if (empty($result)) {
			$data['from'] = 1;
			dao('wechat_user')->data($data)->add();
		}
		else {
			dao('wechat_user')->data($data)->where($where)->save();
		}
	}
}

function get_wechat_user_id($openid)
{
	$unionid = dao('wechat_user')->where(array('openid' => $openid))->getField('unionid');
	$result = get_connect_user($unionid);
	return $result;
}

function update_wechat_unionid($info, $wechat_id = 0)
{
	$wechat_id = (!empty($wechat_id) ? $wechat_id : dao('wechat')->where(array('status' => 1, 'default_wx' => 1))->getField('id'));
	$data = array('wechat_id' => $wechat_id, 'openid' => $info['openid'], 'unionid' => $info['unionid']);

	if (!empty($info['unionid'])) {
		$where = array('openid' => $info['openid'], 'wechat_id' => $wechat_id);
		$res = dao('wechat_user')->field('unionid, ect_uid')->where($where)->find();

		if (empty($res['unionid'])) {
			dao('wechat_user')->data($data)->where($where)->save();

			if (!empty($res['ect_uid'])) {
				$connect_userinfo = get_connect_user($info['unionid']);

				if (empty($connect_userinfo)) {
					dao('connect_user')->data(array('open_id' => $info['unionid']))->where(array('open_id' => $info['openid']))->save();
				}

				$info['user_id'] = $res['ect_uid'];
				update_connnect_user($info, 'wechat');
			}
		}
	}
}

function get_wechat_username($unionid, $type = '')
{
	switch ($type) {
	case 'wechat':
		$prefix = 'wx';
		break;

	case 'qq':
		$prefix = 'qq';
		break;

	case 'weibo':
		$prefix = 'wb';
		break;

	case 'facebook':
		$prefix = 'fb';
		break;

	default:
		$prefix = 'sc';
		break;
	}

	return $prefix . substr(md5($unionid), -5) . substr(time(), 0, 4) . mt_rand(1000, 9999);
}


?>
