<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support;

class AggregateServiceProvider extends ServiceProvider
{
	/**
     * The provider class names.
     *
     * @var array
     */
	protected $providers = array();
	/**
     * An array of the service provider instances.
     *
     * @var array
     */
	protected $instances = array();

	public function register()
	{
		$this->instances = array();

		foreach ($this->providers as $provider) {
			$this->instances[] = $this->app->register($provider);
		}
	}

	public function provides()
	{
		$provides = array();

		foreach ($this->providers as $provider) {
			$instance = $this->app->resolveProvider($provider);
			$provides = array_merge($provides, $instance->provides());
		}

		return $provides;
	}
}

?>
