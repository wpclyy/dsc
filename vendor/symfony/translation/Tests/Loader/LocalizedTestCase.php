<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests\Loader;

abstract class LocalizedTestCase extends \PHPUnit\Framework\TestCase
{
	protected function setUp()
	{
		if (!extension_loaded('intl')) {
			$this->markTestSkipped('Extension intl is required.');
		}
	}
}

?>
