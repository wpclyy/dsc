<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Filesystem;

interface Cloud extends Filesystem
{
	public function url($path);
}

?>
