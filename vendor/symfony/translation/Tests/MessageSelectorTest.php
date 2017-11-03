<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests;

class MessageSelectorTest extends \PHPUnit\Framework\TestCase
{
	public function testChoose($expected, $id, $number)
	{
		$selector = new \Symfony\Component\Translation\MessageSelector();
		$this->assertEquals($expected, $selector->choose($id, $number, 'en'));
	}

	public function testReturnMessageIfExactlyOneStandardRuleIsGiven()
	{
		$selector = new \Symfony\Component\Translation\MessageSelector();
		$this->assertEquals('There are two apples', $selector->choose('There are two apples', 2, 'en'));
	}

	public function testThrowExceptionIfMatchingMessageCannotBeFound($id, $number)
	{
		$selector = new \Symfony\Component\Translation\MessageSelector();
		$selector->choose($id, $number, 'en');
	}

	public function getNonMatchingMessages()
	{
		return array(
	array('{0} There are no apples|{1} There is one apple', 2),
	array('{1} There is one apple|]1,Inf] There are %count% apples', 0),
	array('{1} There is one apple|]2,Inf] There are %count% apples', 2),
	array('{0} There are no apples|There is one apple', 2)
	);
	}

	public function getChooseTests()
	{
		return array(
	array('There are no apples', '{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples', 0),
	array('There are no apples', '{0}     There are no apples|{1} There is one apple|]1,Inf] There are %count% apples', 0),
	array('There are no apples', '{0}There are no apples|{1} There is one apple|]1,Inf] There are %count% apples', 0),
	array('There is one apple', '{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples', 1),
	array('There are %count% apples', '{0} There are no apples|{1} There is one apple|]1,Inf] There are %count% apples', 10),
	array('There are %count% apples', '{0} There are no apples|{1} There is one apple|]1,Inf]There are %count% apples', 10),
	array('There are %count% apples', '{0} There are no apples|{1} There is one apple|]1,Inf]     There are %count% apples', 10),
	array('There are %count% apples', 'There is one apple|There are %count% apples', 0),
	array('There is one apple', 'There is one apple|There are %count% apples', 1),
	array('There are %count% apples', 'There is one apple|There are %count% apples', 10),
	array('There are %count% apples', 'one: There is one apple|more: There are %count% apples', 0),
	array('There is one apple', 'one: There is one apple|more: There are %count% apples', 1),
	array('There are %count% apples', 'one: There is one apple|more: There are %count% apples', 10),
	array('There are no apples', '{0} There are no apples|one: There is one apple|more: There are %count% apples', 0),
	array('There is one apple', '{0} There are no apples|one: There is one apple|more: There are %count% apples', 1),
	array('There are %count% apples', '{0} There are no apples|one: There is one apple|more: There are %count% apples', 10),
	array('', '{0}|{1} There is one apple|]1,Inf] There are %count% apples', 0),
	array('', '{0} There are no apples|{1}|]1,Inf] There are %count% apples', 1),
	array('There are %count% apples', 'There is one apple|There are %count% apples', 0),
	array('There is one apple', 'There is one apple|There are %count% apples', 1),
	array('There are %count% apples', 'There is one apple|There are %count% apples', 2),
	array('There is almost one apple', '{0} There are no apples|]0,1[ There is almost one apple|{1} There is one apple|[1,Inf] There is more than one apple', 0.69999999999999996),
	array('There is one apple', '{0} There are no apples|]0,1[There are %count% apples|{1} There is one apple|[1,Inf] There is more than one apple', 1),
	array('There is more than one apple', '{0} There are no apples|]0,1[There are %count% apples|{1} There is one apple|[1,Inf] There is more than one apple', 1.7),
	array('There are no apples', '{0} There are no apples|]0,1[There are %count% apples|{1} There is one apple|[1,Inf] There is more than one apple', 0),
	array('There are no apples', '{0} There are no apples|]0,1[There are %count% apples|{1} There is one apple|[1,Inf] There is more than one apple', 0),
	array('There are no apples', '{0.0} There are no apples|]0,1[There are %count% apples|{1} There is one apple|[1,Inf] There is more than one apple', 0),
	array("This is a text with a\n            new-line in it. Selector = 0.", "{0}This is a text with a\n            new-line in it. Selector = 0.|{1}This is a text with a\n            new-line in it. Selector = 1.|[1,Inf]This is a text with a\n            new-line in it. Selector > 1.", 0),
	array("This is a text with a\n            new-line in it. Selector = 1.", "{0}This is a text with a\n            new-line in it. Selector = 0.|{1}This is a text with a\n            new-line in it. Selector = 1.|[1,Inf]This is a text with a\n            new-line in it. Selector > 1.", 1),
	array("This is a text with a\n            new-line in it. Selector > 1.", "{0}This is a text with a\n            new-line in it. Selector = 0.|{1}This is a text with a\n            new-line in it. Selector = 1.|[1,Inf]This is a text with a\n            new-line in it. Selector > 1.", 5),
	array("This is a text with a\n            new-line in it. Selector = 1.", "{0}This is a text with a\n            new-line in it. Selector = 0.|{1}This is a text with a\n            new-line in it. Selector = 1.|[1,Inf]This is a text with a\n            new-line in it. Selector > 1.", 1),
	array("This is a text with a\n            new-line in it. Selector > 1.", "{0}This is a text with a\n            new-line in it. Selector = 0.|{1}This is a text with a\n            new-line in it. Selector = 1.|[1,Inf]This is a text with a\n            new-line in it. Selector > 1.", 5),
	array('This is a text with a\\nnew-line in it. Selector = 0.', '{0}This is a text with a\\nnew-line in it. Selector = 0.|{1}This is a text with a\\nnew-line in it. Selector = 1.|[1,Inf]This is a text with a\\nnew-line in it. Selector > 1.', 0),
	array("This is a text with a\nnew-line in it. Selector = 1.", "{0}This is a text with a\nnew-line in it. Selector = 0.|{1}This is a text with a\nnew-line in it. Selector = 1.|[1,Inf]This is a text with a\nnew-line in it. Selector > 1.", 1),
	array('This is a text with | in it. Selector = 0.', '{0}This is a text with || in it. Selector = 0.|{1}This is a text with || in it. Selector = 1.', 0)
	);
	}
}

?>
