<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

interface ConnectionInterface
{
	public function table($table);

	public function raw($value);

	public function selectOne($query, $bindings = array());

	public function select($query, $bindings = array());

	public function insert($query, $bindings = array());

	public function update($query, $bindings = array());

	public function delete($query, $bindings = array());

	public function statement($query, $bindings = array());

	public function affectingStatement($query, $bindings = array());

	public function unprepared($query);

	public function prepareBindings(array $bindings);

	public function transaction(\Closure $callback, $attempts = 1);

	public function beginTransaction();

	public function commit();

	public function rollBack();

	public function transactionLevel();

	public function pretend(\Closure $callback);
}


?>
