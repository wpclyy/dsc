<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Validation;

interface Factory
{
	public function make(array $data, array $rules, array $messages = array(), array $customAttributes = array());

	public function extend($rule, $extension, $message = NULL);

	public function extendImplicit($rule, $extension, $message = NULL);

	public function replacer($rule, $replacer);
}


?>
