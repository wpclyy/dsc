<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\View;

interface Factory
{
	public function exists($view);

	public function file($path, $data = array(), $mergeData = array());

	public function make($view, $data = array(), $mergeData = array());

	public function share($key, $value = NULL);

	public function composer($views, $callback);

	public function creator($views, $callback);

	public function addNamespace($namespace, $hints);

	public function replaceNamespace($namespace, $hints);
}


?>
