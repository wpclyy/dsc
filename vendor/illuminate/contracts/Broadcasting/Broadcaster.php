<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Broadcasting;

interface Broadcaster
{
	public function auth($request);

	public function validAuthenticationResponse($request, $result);

	public function broadcast(array $channels, $event, array $payload = array());
}


?>
