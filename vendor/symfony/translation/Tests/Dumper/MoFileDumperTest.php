<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests\Dumper;

class MoFileDumperTest extends \PHPUnit\Framework\TestCase
{
	public function testFormatCatalogue()
	{
		$catalogue = new \Symfony\Component\Translation\MessageCatalogue('en');
		$catalogue->add(array('foo' => 'bar'));
		$dumper = new \Symfony\Component\Translation\Dumper\MoFileDumper();
		$this->assertStringEqualsFile(__DIR__ . '/../fixtures/resources.mo', $dumper->formatCatalogue($catalogue, 'messages'));
	}
}

?>
