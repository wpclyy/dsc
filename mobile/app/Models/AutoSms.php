<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class AutoSms extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'auto_sms';
	protected $primaryKey = 'item_id';
	public $timestamps = false;
	protected $fillable = array('item_type', 'user_id', 'ru_id', 'order_id', 'add_time');
	protected $guarded = array();
}

?>
