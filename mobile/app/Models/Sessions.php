<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class Sessions extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'sessions';
	protected $primaryKey = 'sesskey';
	public $timestamps = false;
	protected $fillable = array('expiry', 'userid', 'adminid', 'ip', 'user_name', 'user_rank', 'discount', 'email', 'data');
	protected $guarded = array();
}

?>
