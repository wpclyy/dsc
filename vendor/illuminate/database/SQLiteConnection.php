<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

class SQLiteConnection extends Connection
{
	protected function getDefaultQueryGrammar()
	{
		return $this->withTablePrefix(new Query\Grammars\SQLiteGrammar());
	}

	protected function getDefaultSchemaGrammar()
	{
		return $this->withTablePrefix(new Schema\Grammars\SQLiteGrammar());
	}

	protected function getDefaultPostProcessor()
	{
		return new Query\Processors\SQLiteProcessor();
	}

	protected function getDoctrineDriver()
	{
		return new \Doctrine\DBAL\Driver\PDOSqlite\Driver();
	}
}

?>
