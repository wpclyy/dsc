<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface UserProvider
{
	public function retrieveById($identifier);

	public function retrieveByToken($identifier, $token);

	public function updateRememberToken(Authenticatable $user, $token);

	public function retrieveByCredentials(array $credentials);

	public function validateCredentials(Authenticatable $user, array $credentials);
}


?>
