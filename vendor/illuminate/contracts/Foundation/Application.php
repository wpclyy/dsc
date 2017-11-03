<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Foundation;

interface Application extends \Illuminate\Contracts\Container\Container
{
	public function version();

	public function basePath();

	public function environment();

	public function isDownForMaintenance();

	public function registerConfiguredProviders();

	public function register($provider, $options = array(), $force = false);

	public function registerDeferredProvider($provider, $service = NULL);

	public function boot();

	public function booting($callback);

	public function booted($callback);

	public function getCachedServicesPath();
}

?>
