<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Services;

class AuthService
{
	private $request;
	private $userRepository;
	private $WechatUserRepository;

	public function __construct(\App\Repositories\User\UserRepository $userRepository, \App\Repositories\Wechat\WechatUserRepository $WechatUserRepository)
	{
		$this->userRepository = $userRepository;
		$this->WechatUserRepository = $WechatUserRepository;
	}

	public function loginMiddleWare(array $request)
	{
		$this->request = $request['userinfo'];
		$result = $this->wxLogin($request['code']);
		if (isset($result['token']) && isset($result['unionid'])) {
			return $result;
		}

		return false;
	}

	private function wxLogin($code)
	{
		$request = $this->request;
		$config = array('appid' => app('config')->get('app.WX_MINI_APPID'), 'secret' => app('config')->get('app.WX_MINI_SECRET'));
		$wxapp = new \App\Extensions\Wxapp($config);
		$response = $wxapp->getOauthOrization($code);
		if (!empty($response) && isset($response['unionid'])) {
		}
		else {
			if ($wxapp->errCode == '40029') {
				$wxapp->log($wxapp->errMsg);
			}

			return false;
		}

		$connectUser = $this->userRepository->getConnectUser($response['unionid']);
		$args['unionid'] = $response['unionid'];
		$args['openid'] = $response['openid'];
		$args['nickname'] = isset($request['nickName']) ? $request['nickName'] : '';
		$args['sex'] = isset($request['gender']) ? $request['gender'] : '';
		$args['province'] = isset($request['province']) ? $request['province'] : '';
		$args['city'] = isset($request['city']) ? $request['city'] : '';
		$args['country'] = isset($request['country']) ? $request['country'] : '';
		$args['headimgurl'] = isset($request['avatarUrl']) ? $request['avatarUrl'] : '';

		if (empty($connectUser)) {
			$result = $this->createUser($args);

			if ($result['error_code'] == 0) {
				$args['user_id'] = $result['user_id'];
				if ($args['user_id'] && $args['unionid']) {
					$this->creatConnectUser($args);
					$this->creatWechatUser($args);
				}
			}
		}

		$args['user_id'] = !empty($args['user_id']) ? $args['user_id'] : $connectUser['user_id'];
		$this->updateUser($args);
		$this->connectUserUpdate($args);
		$this->wechatUserUpdate($args);
		$token = \App\Api\Foundation\Token::encode(array('uid' => $args['user_id']));
		return array('token' => $token, 'openid' => $args['openid'], 'unionid' => $args['unionid']);
	}

	public function createUser($args)
	{
		$username = 'wx' . substr(md5($args['unionid']), -5) . substr(time(), 0, 4) . mt_rand(1000, 9999);
		$newUser = array('user_name' => $username, 'password' => $this->generatePassword(mt_rand(100000, 999999)), 'email' => $username . '@qq.com');
		$extends = array('nick_name' => $args['nickname'], 'sex' => $args['sex'], 'user_picture' => $args['headimgurl'], 'reg_time' => gmtime());

		if (!\App\Models\User::where(array('user_name' => $username))->first()) {
			$model = new \App\Models\User();
			$data = array_merge($newUser, $extends);
			$model->fill($data);

			if ($model->save()) {
				$token = \App\Api\Foundation\Token::encode(array('uid' => $model->user_id));
				return array('error_code' => 0, 'token' => $token, 'user_id' => $model->user_id);
			}
			else {
				return array('error_code' => 1, 'msg' => '创建用户失败');
			}
		}
		else {
			return array('error_code' => 1, 'msg' => '用户已存在');
		}
	}

	public function updateUser($args)
	{
		$data = array('user_id' => $args['user_id'], 'nick_name' => $args['nickname'], 'sex' => $args['sex'], 'user_picture' => $args['headimgurl']);
		$res = $this->userRepository->renewUser($data);
		return $res;
	}

	public function creatConnectUser($args, $type = 'wechat')
	{
		$profile = array('nickname' => $args['nickname'], 'sex' => $args['sex'], 'province' => $args['province'], 'city' => $args['city'], 'country' => $args['country'], 'headimgurl' => $args['headimgurl']);
		$data = array('connect_code' => 'sns_' . $type, 'user_id' => $args['user_id'], 'open_id' => $args['unionid'], 'profile' => serialize($profile), 'create_at' => gmtime());
		$res = $this->userRepository->addConnectUser($data);
		return $res;
	}

	public function connectUserUpdate($args, $type = 'wechat')
	{
		$profile = array('nickname' => $args['nickname'], 'sex' => $args['sex'], 'province' => $args['province'], 'city' => $args['city'], 'country' => $args['country'], 'headimgurl' => $args['headimgurl']);
		$data = array('connect_code' => 'sns_' . $type, 'user_id' => $args['user_id'], 'open_id' => $args['unionid'], 'profile' => serialize($profile));
		$res = $this->userRepository->updateConnnectUser($data);
		return $res;
	}

	public function creatWechatUser($args)
	{
		$data = array('nickname' => $args['nickname'], 'sex' => $args['sex'], 'city' => $args['city'], 'country' => isset($args['country']) ? $args['country'] : '', 'province' => $args['province'], 'language' => isset($args['language']) ? $args['language'] : '', 'headimgurl' => $args['headimgurl'], 'remark' => isset($args['remark']) ? $args['remark'] : '', 'openid' => $args['openid'], 'unionid' => $args['unionid'], 'ect_uid' => $args['user_id']);
		$res = $this->WechatUserRepository->addWechatUser($data);
		return $res;
	}

	public function wechatUserUpdate($args)
	{
		$data = array('nickname' => $args['nickname'], 'sex' => $args['sex'], 'city' => $args['city'], 'country' => isset($args['country']) ? $args['country'] : '', 'province' => $args['province'], 'language' => isset($args['language']) ? $args['language'] : '', 'headimgurl' => $args['headimgurl'], 'remark' => isset($args['remark']) ? $args['remark'] : '', 'openid' => $args['openid'], 'unionid' => $args['unionid']);
		$res = $this->WechatUserRepository->updateWechatUser($data);
		return $res;
	}

	public function generatePassword($password, $salt = false)
	{
		if ($salt) {
			return md5(md5($password) . $salt);
		}

		return md5($password);
	}

	public function authorization()
	{
		$token = $_SERVER[strtoupper('HTTP_X_' . app('config')->get('app.name') . '_Authorization')];

		if (empty($token)) {
			return array('error' => 1, 'msg' => strtolower('header parameter `x-' . app('config')->get('app.name') . '-authorization` is required'));
		}

		if ($payload = \App\Api\Foundation\Token::decode($token)) {
			if (is_object($payload) && property_exists($payload, 'uid')) {
				return $payload->uid;
			}
		}

		if ($payload == 10002) {
			return array('error' => 1, 'msg' => 'token-expired');
		}

		return array('error' => 1, 'msg' => 'token-illegal');
	}
}


?>
