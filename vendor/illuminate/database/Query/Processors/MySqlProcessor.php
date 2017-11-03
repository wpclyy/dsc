<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Query\Processors;

class MySqlProcessor extends Processor
{
	public function processColumnListing($results)
	{
		return array_map(function($result) {
			return with((object) $result)->column_name;
		}, $results);
	}
}

?>
