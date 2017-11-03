<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Hashing;

interface Hasher
{
	public function make($value, array $options = array());

	public function check($value, $hashedValue, array $options = array());

	public function needsRehash($hashedValue, array $options = array());
}


?>
