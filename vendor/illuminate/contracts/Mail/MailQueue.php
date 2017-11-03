<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Mail;

interface MailQueue
{
	public function queue($view, array $data, $callback, $queue = NULL);

	public function later($delay, $view, array $data, $callback, $queue = NULL);
}


?>
