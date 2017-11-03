<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

trait DetectsDeadlocks
{
	protected function causedByDeadlock(\Exception $e)
	{
		$message = $e->getMessage();
		return \Illuminate\Support\Str::contains($message, array('Deadlock found when trying to get lock', 'deadlock detected', 'The database file is locked', 'database is locked', 'database table is locked', 'A table in the database is locked', 'has been chosen as the deadlock victim'));
	}
}


?>
