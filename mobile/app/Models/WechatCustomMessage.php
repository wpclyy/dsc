<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class WechatCustomMessage extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'wechat_custom_message';
	public $timestamps = false;
	protected $fillable = array('wechat_id', 'uid', 'msg', 'send_time', 'is_wechat_admin');
	protected $guarded = array();
}

?>
