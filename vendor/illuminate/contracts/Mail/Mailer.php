<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Mail;

interface Mailer
{
	public function raw($text, $callback);

	public function send($view, array $data = array(), $callback = NULL);

	public function failures();
}


?>
