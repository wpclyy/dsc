<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Migrations;

abstract class Migration
{
	/**
     * The name of the database connection to use.
     *
     * @var string
     */
	protected $connection;

	public function getConnection()
	{
		return $this->connection;
	}
}


?>
