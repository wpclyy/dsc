<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Queue extends Facade
{
	static public function fake()
	{
		static::swap(new \Illuminate\Support\Testing\Fakes\QueueFake(static::getFacadeApplication()));
	}

	static protected function getFacadeAccessor()
	{
		return 'queue';
	}
}

?>
