<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Events;

abstract class ConnectionEvent
{
	/**
     * The name of the connection.
     *
     * @var string
     */
	public $connectionName;
	/**
     * The database connection instance.
     *
     * @var \Illuminate\Database\Connection
     */
	public $connection;

	public function __construct($connection)
	{
		$this->connection = $connection;
		$this->connectionName = $connection->getName();
	}
}


?>
