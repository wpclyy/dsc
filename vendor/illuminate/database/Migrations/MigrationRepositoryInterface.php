<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Migrations;

interface MigrationRepositoryInterface
{
	public function getRan();

	public function getMigrations($steps);

	public function getLast();

	public function log($file, $batch);

	public function delete($migration);

	public function getNextBatchNumber();

	public function createRepository();

	public function repositoryExists();

	public function setSource($name);
}


?>
