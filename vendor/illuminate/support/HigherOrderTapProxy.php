<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support;

class HigherOrderTapProxy
{
	/**
     * The target being tapped.
     *
     * @var mixed
     */
	public $target;

	public function __construct($target)
	{
		$this->target = $target;
	}

	public function __call($method, $parameters)
	{
		$this->target->$method(...$parameters);
		return $this->target;
	}
}


?>
