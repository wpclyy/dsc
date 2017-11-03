<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Doctrine\Tests;

error_reporting(E_ALL | E_STRICT);
spl_autoload_register(function($class) {
	if (0 === strpos($class, 'Doctrine\\Tests\\')) {
		$path = __DIR__ . '/../../' . strtr($class, '\\', '/') . '.php';
		if (is_file($path) && is_readable($path)) {
			require_once $path;
			return true;
		}
	}
	else if (0 === strpos($class, 'Doctrine\\Common\\')) {
		$path = __DIR__ . '/../../../lib/' . ($class = strtr($class, '\\', '/')) . '.php';
		if (is_file($path) && is_readable($path)) {
			require_once $path;
			return true;
		}
	}
});

?>
