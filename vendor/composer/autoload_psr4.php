<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);
return array(
	'Symfony\\Polyfill\\Mbstring\\'     => array($vendorDir . '/symfony/polyfill-mbstring'),
	'Symfony\\Component\\Translation\\' => array($vendorDir . '/symfony/translation'),
	'Payment\\'                         => array($vendorDir . '/riverslei/payment/src'),
	'Illuminate\\Support\\'             => array($vendorDir . '/illuminate/support'),
	'Illuminate\\Database\\'            => array($vendorDir . '/illuminate/database'),
	'Illuminate\\Contracts\\'           => array($vendorDir . '/illuminate/contracts'),
	'Illuminate\\Container\\'           => array($vendorDir . '/illuminate/container'),
	'Carbon\\'                          => array($vendorDir . '/nesbot/carbon/src/Carbon')
	);

?>
