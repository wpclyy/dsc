<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class OrderInvoice extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'order_invoice';
	protected $primaryKey = 'invoice_id';
	public $timestamps = false;
	protected $fillable = array('user_id', 'inv_payee', 'tax_id');
	protected $guarded = array();
}

?>
