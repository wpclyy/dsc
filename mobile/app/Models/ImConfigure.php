<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class ImConfigure extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'im_configure';
	public $timestamps = false;
	protected $fillable = array('ser_id', 'type', 'content', 'is_on');
	protected $guarded = array();
}

?>
