<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Schema extends Facade
{
	static public function connection($name)
	{
		return static::$app['db']->connection($name)->getSchemaBuilder();
	}

	static protected function getFacadeAccessor()
	{
		return static::$app['db']->connection()->getSchemaBuilder();
	}
}

?>
