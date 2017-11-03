<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Bus extends Facade
{
	static public function fake()
	{
		static::swap(new \Illuminate\Support\Testing\Fakes\BusFake());
	}

	static protected function getFacadeAccessor()
	{
		return 'Illuminate\\Contracts\\Bus\\Dispatcher';
	}
}

?>
