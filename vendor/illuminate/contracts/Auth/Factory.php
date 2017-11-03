<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Auth;

interface Factory
{
	public function guard($name = NULL);

	public function shouldUse($name);
}


?>
