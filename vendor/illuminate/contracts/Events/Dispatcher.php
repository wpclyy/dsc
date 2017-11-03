<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Events;

interface Dispatcher
{
	public function listen($events, $listener);

	public function hasListeners($eventName);

	public function subscribe($subscriber);

	public function until($event, $payload = array());

	public function dispatch($event, $payload = array(), $halt = false);

	public function push($event, $payload = array());

	public function flush($event);

	public function forget($event);

	public function forgetPushed();
}


?>
