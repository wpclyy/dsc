<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class EntryCriteria extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'entry_criteria';
	public $timestamps = false;
	protected $fillable = array('parent_id', 'criteria_name', 'charge', 'standard_name', 'type', 'is_mandatory', 'option_value');
	protected $guarded = array();
}

?>
