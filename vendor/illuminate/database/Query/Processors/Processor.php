<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Query\Processors;

class Processor
{
	public function processSelect(\Illuminate\Database\Query\Builder $query, $results)
	{
		return $results;
	}

	public function processInsertGetId(\Illuminate\Database\Query\Builder $query, $sql, $values, $sequence = NULL)
	{
		$query->getConnection()->insert($sql, $values);
		$id = $query->getConnection()->getPdo()->lastInsertId($sequence);
		return is_numeric($id) ? (int) $id : $id;
	}

	public function processColumnListing($results)
	{
		return $results;
	}
}


?>
