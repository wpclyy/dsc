<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Debug;

interface ExceptionHandler
{
	public function report(\Exception $e);

	public function render($request, \Exception $e);

	public function renderForConsole($output, \Exception $e);
}


?>
