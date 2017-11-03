<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Traits;

trait CapsuleManagerTrait
{
	/**
     * The current globally used instance.
     *
     * @var object
     */
	static protected $instance;
	/**
     * The container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
	protected $container;

	protected function setupContainer(\Illuminate\Contracts\Container\Container $container)
	{
		$this->container = $container;

		if (!$this->container->bound('config')) {
			$this->container->instance('config', new \Illuminate\Support\Fluent());
		}
	}

	public function setAsGlobal()
	{
		static::$instance = $this;
	}

	public function getContainer()
	{
		return $this->container;
	}

	public function setContainer(\Illuminate\Contracts\Container\Container $container)
	{
		$this->container = $container;
	}
}


?>
