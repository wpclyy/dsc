<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Pipeline;

interface Pipeline
{
	public function send($traveler);

	public function through($stops);

	public function via($method);

	public function then(\Closure $destination);
}


?>
