<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Events;

class StatementPrepared
{
	/**
     * The database connection instance.
     *
     * @var \Illuminate\Database\Connection
     */
	public $connection;
	/**
     * The PDO statement.
     *
     * @var \PDOStatement
     */
	public $statement;

	public function __construct($connection, $statement)
	{
		$this->statement = $statement;
		$this->connection = $connection;
	}
}


?>
