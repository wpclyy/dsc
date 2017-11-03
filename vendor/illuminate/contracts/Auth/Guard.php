<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface Guard
{
	public function check();

	public function guest();

	public function user();

	public function id();

	public function validate(array $credentials = array());

	public function setUser(Authenticatable $user);
}


?>
