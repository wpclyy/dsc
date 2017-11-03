<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

class MigrationServiceProvider extends \Illuminate\Support\ServiceProvider
{
	/**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
	protected $defer = true;

	public function register()
	{
		$this->registerRepository();
		$this->registerMigrator();
		$this->registerCreator();
	}

	protected function registerRepository()
	{
		$this->app->singleton('migration.repository', function($app) {
			$table = $app['config']['database.migrations'];
			return new Migrations\DatabaseMigrationRepository($app['db'], $table);
		});
	}

	protected function registerMigrator()
	{
		$this->app->singleton('migrator', function($app) {
			$repository = $app['migration.repository'];
			return new Migrations\Migrator($repository, $app['db'], $app['files']);
		});
	}

	protected function registerCreator()
	{
		$this->app->singleton('migration.creator', function($app) {
			return new Migrations\MigrationCreator($app['files']);
		});
	}

	public function provides()
	{
		return array('migrator', 'migration.repository', 'migration.creator');
	}
}

?>
