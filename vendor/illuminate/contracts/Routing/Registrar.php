<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Routing;

interface Registrar
{
	public function get($uri, $action);

	public function post($uri, $action);

	public function put($uri, $action);

	public function delete($uri, $action);

	public function patch($uri, $action);

	public function options($uri, $action);

	public function match($methods, $uri, $action);

	public function resource($name, $controller, array $options = array());

	public function group(array $attributes, $routes);

	public function substituteBindings($route);

	public function substituteImplicitBindings($route);
}


?>
