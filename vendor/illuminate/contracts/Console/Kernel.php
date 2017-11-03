<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Console;

interface Kernel
{
	public function handle($input, $output = NULL);

	public function call($command, array $parameters = array());

	public function queue($command, array $parameters = array());

	public function all();

	public function output();
}


?>
