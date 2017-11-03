<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Cookie;

interface QueueingFactory extends Factory
{
	public function queue(...$parameters);

	public function unqueue($name);

	public function getQueuedCookies();
}

?>
