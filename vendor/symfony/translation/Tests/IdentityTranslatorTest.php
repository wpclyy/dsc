<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests;

class IdentityTranslatorTest extends \PHPUnit\Framework\TestCase
{
	public function testTrans($expected, $id, $parameters)
	{
		$translator = new \Symfony\Component\Translation\IdentityTranslator();
		$this->assertEquals($expected, $translator->trans($id, $parameters));
	}

	public function testTransChoiceWithExplicitLocale($expected, $id, $number, $parameters)
	{
		$translator = new \Symfony\Component\Translation\IdentityTranslator();
		$translator->setLocale('en');
		$this->assertEquals($expected, $translator->transChoice($id, $number, $parameters));
	}

	public function testTransChoiceWithDefaultLocale($expected, $id, $number, $parameters)
	{
		\Locale::setDefault('en');
		$translator = new \Symfony\Component\Translation\IdentityTranslator();
		$this->assertEquals($expected, $translator->transChoice($id, $number, $parameters));
	}

	public function testGetSetLocale()
	{
		$translator = new \Symfony\Component\Translation\IdentityTranslator();
		$translator->setLocale('en');
		$this->assertEquals('en', $translator->getLocale());
	}

	public function testGetLocaleReturnsDefaultLocaleIfNotSet()
	{
		\Symfony\Component\Intl\Util\IntlTestHelper::requireFullIntl($this, false);
		$translator = new \Symfony\Component\Translation\IdentityTranslator();
		\Locale::setDefault('en');
		$this->assertEquals('en', $translator->getLocale());
		\Locale::setDefault('pt_BR');
		$this->assertEquals('pt_BR', $translator->getLocale());
	}

	public function getTransTests()
	{
		return array(
	array(
		'Symfony is great!',
		'Symfony is great!',
		array()
		),
	array(
		'Symfony is awesome!',
		'Symfony is %what%!',
		array('%what%' => 'awesome')
		)
	);
	}

	public function getTransChoiceTests()
	{
		return array(
	array(
		'There are no apples',
		'{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples',
		0,
		array('%count%' => 0)
		),
	array(
		'There is one apple',
		'{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples',
		1,
		array('%count%' => 1)
		),
	array(
		'There are 10 apples',
		'{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples',
		10,
		array('%count%' => 10)
		),
	array(
		'There are 0 apples',
		'There is 1 apple|There are %count% apples',
		0,
		array('%count%' => 0)
		),
	array(
		'There is 1 apple',
		'There is 1 apple|There are %count% apples',
		1,
		array('%count%' => 1)
		),
	array(
		'There are 10 apples',
		'There is 1 apple|There are %count% apples',
		10,
		array('%count%' => 10)
		),
	array(
		'There are 2 apples',
		'There are 2 apples',
		2,
		array('%count%' => 2)
		)
	);
	}
}

?>
