<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support\Facades;

class Storage extends Facade
{
	static public function fake($disk)
	{
		(new \Illuminate\Filesystem\Filesystem())->cleanDirectory($root = storage_path('framework/testing/disks/' . $disk));
		static::set($disk, self::createLocalDriver(array('root' => $root)));
	}

	static protected function getFacadeAccessor()
	{
		return 'filesystem';
	}
}

?>
