<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Config;

interface Repository
{
	public function has($key);

	public function get($key, $default = NULL);

	public function all();

	public function set($key, $value = NULL);

	public function prepend($key, $value);

	public function push($key, $value);
}


?>
