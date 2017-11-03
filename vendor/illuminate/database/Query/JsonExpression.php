<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Query;

class JsonExpression extends Expression
{
	/**
     * The value of the expression.
     *
     * @var mixed
     */
	protected $value;

	public function __construct($value)
	{
		$this->value = $this->getJsonBindingParameter($value);
	}

	protected function getJsonBindingParameter($value)
	{
		switch ($type = gettype($value)) {
		case 'boolean':
			return $value ? 'true' : 'false';
		case 'integer':
		case 'double':
			return $value;
		case 'string':
			return '?';
		case 'object':
		case 'array':
			return '?';
		}

		throw new \InvalidArgumentException('JSON value is of illegal type: ' . $type);
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
