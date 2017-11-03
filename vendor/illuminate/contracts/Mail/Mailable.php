<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Mail;

interface Mailable
{
	public function send(Mailer $mailer);

	public function queue(\Illuminate\Contracts\Queue\Factory $queue);

	public function later($delay, \Illuminate\Contracts\Queue\Factory $queue);
}


?>
