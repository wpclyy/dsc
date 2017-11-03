<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Validation;

interface Validator extends \Illuminate\Contracts\Support\MessageProvider
{
	public function fails();

	public function failed();

	public function sometimes($attribute, $rules,  $callback);

	public function after($callback);
}

?>
