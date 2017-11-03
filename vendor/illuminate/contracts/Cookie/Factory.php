<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Cookie;

interface Factory
{
	public function make($name, $value, $minutes = 0, $path = NULL, $domain = NULL, $secure = false, $httpOnly = true);

	public function forever($name, $value, $path = NULL, $domain = NULL, $secure = false, $httpOnly = true);

	public function forget($name, $path = NULL, $domain = NULL);
}


?>
