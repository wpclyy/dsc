<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Event extends Facade
{
	static public function fake()
	{
		static::swap($fake = new \Illuminate\Support\Testing\Fakes\EventFake());
		\Illuminate\Database\Eloquent\Model::setEventDispatcher($fake);
	}

	static protected function getFacadeAccessor()
	{
		return 'events';
	}
}

?>
