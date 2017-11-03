<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Api\Transformers;

class LocationTransformer extends \League\Fractal\TransformerAbstract
{
	public function transform()
	{
		return array('id' => $location->parent_id);
	}
}

?>
