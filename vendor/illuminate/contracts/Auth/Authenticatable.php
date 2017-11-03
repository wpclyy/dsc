<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface Authenticatable
{
	public function getAuthIdentifierName();

	public function getAuthIdentifier();

	public function getAuthPassword();

	public function getRememberToken();

	public function setRememberToken($value);

	public function getRememberTokenName();
}


?>
