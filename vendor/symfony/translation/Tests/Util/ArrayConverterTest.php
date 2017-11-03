<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests\Util;

class ArrayConverterTest extends \PHPUnit\Framework\TestCase
{
	public function testDump($input, $expectedOutput)
	{
		$this->assertEquals($expectedOutput, \Symfony\Component\Translation\Util\ArrayConverter::expandToTree($input));
	}

	public function messagesData()
	{
		return array(
	array(
		array('foo1' => 'bar', 'foo.bar' => 'value'),
		array(
			'foo1' => 'bar',
			'foo'  => array('bar' => 'value')
			)
		),
	array(
		array('foo.bar' => 'value1', 'foo.bar.test' => 'value2'),
		array(
			'foo' => array('bar' => 'value1', 'bar.test' => 'value2')
			)
		),
	array(
		array('foo.level2.level3.level4' => 'value1', 'foo.level2' => 'value2', 'foo.bar' => 'value3'),
		array(
			'foo' => array('level2' => 'value2', 'level2.level3.level4' => 'value1', 'bar' => 'value3')
			)
		)
	);
	}
}

?>
