<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Input extends Facade
{
	static public function get($key = NULL, $default = NULL)
	{
		return static::$app['request']->input($key, $default);
	}

	static protected function getFacadeAccessor()
	{
		return 'request';
	}
}

?>
