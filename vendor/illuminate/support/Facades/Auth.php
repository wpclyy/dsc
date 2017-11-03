<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Auth extends Facade
{
	static protected function getFacadeAccessor()
	{
		return 'auth';
	}

	static public function routes()
	{
		static::$app->make('router')->auth();
	}
}

?>
