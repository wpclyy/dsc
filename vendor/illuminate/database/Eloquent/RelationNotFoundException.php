<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent;

class RelationNotFoundException extends \RuntimeException
{
	static public function make($model, $relation)
	{
		$class = get_class($model);
		return new static('Call to undefined relationship [' . $relation . '] on model [' . $class . '].');
	}
}

?>
