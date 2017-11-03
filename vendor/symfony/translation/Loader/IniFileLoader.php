<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Loader;

class IniFileLoader extends FileLoader
{
	protected function loadResource($resource)
	{
		return parse_ini_file($resource, true);
	}
}

?>
