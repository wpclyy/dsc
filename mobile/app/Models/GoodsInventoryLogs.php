<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class GoodsInventoryLogs extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'goods_inventory_logs';
	public $timestamps = false;
	protected $fillable = array('goods_id', 'order_id', 'use_storage', 'admin_id', 'number', 'model_inventory', 'model_attr', 'product_id', 'warehouse_id', 'area_id', 'add_time');
	protected $guarded = array();
}

?>
