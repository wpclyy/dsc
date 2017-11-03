<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Models;

class OrderInfo extends \Illuminate\Database\Eloquent\Model
{
	const STATUS_CREATED = 0;
	const STATUS_PAID = 1;
	const STATUS_DELIVERING = 2;
	const STATUS_DELIVERIED = 3;
	const STATUS_FINISHED = 4;
	const STATUS_CANCELLED = 5;
	const OS_UNCONFIRMED = 0;
	const OS_CONFIRMED = 1;
	const OS_CANCELED = 2;
	const OS_INVALID = 3;
	const OS_RETURNED = 4;
	const OS_SPLITED = 5;
	const OS_SPLITING_PART = 6;
	const PS_UNPAYED = 0;
	const PS_PAYING = 1;
	const PS_PAYED = 2;
	const SS_UNSHIPPED = 0;
	const SS_SHIPPED = 1;
	const SS_RECEIVED = 2;
	const SS_PREPARING = 3;
	const SS_SHIPPED_PART = 4;
	const SS_SHIPPED_ING = 5;
	const OS_SHIPPED_PART = 6;

	protected $table = 'order_info';
	protected $primaryKey = 'order_id';
	public $timestamps = false;
	protected $fillable = array('main_order_id', 'order_sn', 'user_id', 'order_status', 'shipping_status', 'pay_status', 'consignee', 'country', 'province', 'city', 'district', 'street', 'address', 'zipcode', 'tel', 'mobile', 'email', 'best_time', 'sign_building', 'postscript', 'shipping_id', 'shipping_name', 'shipping_code', 'shipping_type', 'pay_id', 'pay_name', 'how_oos', 'how_surplus', 'pack_name', 'card_name', 'card_message', 'inv_payee', 'inv_content', 'goods_amount', 'cost_amount', 'shipping_fee', 'insure_fee', 'pay_fee', 'pack_fee', 'card_fee', 'money_paid', 'surplus', 'integral', 'integral_money', 'bonus', 'order_amount', 'from_ad', 'referer', 'add_time', 'confirm_time', 'pay_time', 'shipping_time', 'confirm_take_time', 'auto_delivery_time', 'pack_id', 'card_id', 'bonus_id', 'invoice_no', 'extension_code', 'extension_id', 'to_buyer', 'pay_note', 'agency_id', 'inv_type', 'tax', 'is_separate', 'parent_id', 'discount', 'discount_all', 'is_delete', 'is_settlement', 'sign_time', 'is_single', 'point_id', 'shipping_dateStr', 'supplier_id', 'froms', 'coupons', 'is_zc_order', 'zc_goods_id', 'is_frozen', 'drp_is_separate', 'team_id', 'team_parent_id', 'team_user_id', 'team_price', 'chargeoff_status', 'invoice_type', 'vat_id');
	protected $guarded = array();

	public function goods()
	{
		return self::hasMany('App\\Models\\OrderGoods', 'order_id', 'order_id');
	}
}

?>
