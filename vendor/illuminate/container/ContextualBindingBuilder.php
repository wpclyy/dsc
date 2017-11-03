<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Container;

class ContextualBindingBuilder implements \Illuminate\Contracts\Container\ContextualBindingBuilder
{
	/**
     * The underlying container instance.
     *
     * @var \Illuminate\Container\Container
     */
	protected $container;
	/**
     * The concrete instance.
     *
     * @var string
     */
	protected $concrete;
	/**
     * The abstract target.
     *
     * @var string
     */
	protected $needs;

	public function __construct(Container $container, $concrete)
	{
		$this->concrete = $concrete;
		$this->container = $container;
	}

	public function needs($abstract)
	{
		$this->needs = $abstract;
		return $this;
	}

	public function give($implementation)
	{
		$this->container->addContextualBinding($this->concrete, $this->needs, $implementation);
	}
}

?>
