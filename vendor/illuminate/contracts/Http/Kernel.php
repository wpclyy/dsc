<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Http;

interface Kernel
{
	public function bootstrap();

	public function handle($request);

	public function terminate($request, $response);

	public function getApplication();
}


?>
