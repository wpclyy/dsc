<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Bus;

interface Dispatcher
{
	public function dispatch($command);

	public function dispatchNow($command, $handler = NULL);

	public function pipeThrough(array $pipes);
}


?>
