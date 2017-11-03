<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Translation;

interface Translator
{
	public function trans($key, array $replace = array(), $locale = NULL);

	public function transChoice($key, $number, array $replace = array(), $locale = NULL);

	public function getLocale();

	public function setLocale($locale);
}


?>
