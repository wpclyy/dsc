<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

interface TranslatorInterface
{
	public function trans($id, array $parameters = array(), $domain = NULL, $locale = NULL);

	public function transChoice($id, $number, array $parameters = array(), $domain = NULL, $locale = NULL);

	public function setLocale($locale);

	public function getLocale();
}


?>
