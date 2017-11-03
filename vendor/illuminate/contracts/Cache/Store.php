<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Cache;

interface Store
{
	public function get($key);

	public function many(array $keys);

	public function put($key, $value, $minutes);

	public function putMany(array $values, $minutes);

	public function increment($key, $value = 1);

	public function decrement($key, $value = 1);

	public function forever($key, $value);

	public function forget($key);

	public function flush();

	public function getPrefix();
}


?>
