<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Queue;

class EntityNotFoundException extends \InvalidArgumentException
{
	public function __construct($type, $id)
	{
		$id = (string) $id;
		parent::__construct('Queueable entity [' . $type . '] not found for ID [' . $id . '].');
	}
}

?>
