<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Queue;

interface Job
{
	public function fire();

	public function release($delay = 0);

	public function delete();

	public function isDeleted();

	public function isDeletedOrReleased();

	public function attempts();

	public function failed($e);

	public function maxTries();

	public function timeout();

	public function getName();

	public function resolveName();

	public function getConnectionName();

	public function getQueue();

	public function getRawBody();
}


?>
