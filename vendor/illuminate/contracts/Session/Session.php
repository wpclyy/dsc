<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Session;

interface Session
{
	public function getName();

	public function getId();

	public function setId($id);

	public function start();

	public function save();

	public function all();

	public function exists($key);

	public function has($key);

	public function get($key, $default = NULL);

	public function put($key, $value = NULL);

	public function token();

	public function remove($key);

	public function forget($keys);

	public function flush();

	public function migrate($destroy = false);

	public function isStarted();

	public function previousUrl();

	public function setPreviousUrl($url);

	public function getHandler();

	public function handlerNeedsRequest();

	public function setRequestOnHandler($request);
}


?>
