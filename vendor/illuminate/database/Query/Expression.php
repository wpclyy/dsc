<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Query;

class Expression
{
	/**
     * The value of the expression.
     *
     * @var mixed
     */
	protected $value;

	public function __construct($value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function __toString()
	{
		return (string) $this->getValue();
	}
}


?>
