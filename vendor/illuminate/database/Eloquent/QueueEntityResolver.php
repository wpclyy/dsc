<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent;

class QueueEntityResolver implements \Illuminate\Contracts\Queue\EntityResolver
{
	public function resolve($type, $id)
	{
		$instance = (new $type())->find($id);

		if ($instance) {
			return $instance;
		}

		throw new \Illuminate\Contracts\Queue\EntityNotFoundException($type, $id);
	}
}

?>
