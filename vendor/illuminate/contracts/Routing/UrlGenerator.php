<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Routing;

interface UrlGenerator
{
	public function current();

	public function to($path, $extra = array(), $secure = NULL);

	public function secure($path, $parameters = array());

	public function asset($path, $secure = NULL);

	public function route($name, $parameters = array(), $absolute = true);

	public function action($action, $parameters = array(), $absolute = true);

	public function setRootControllerNamespace($rootNamespace);
}


?>
