<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment;

final class Config
{
	const VERSION = '3.1.1-dev';
	const ALI_CHANNEL_APP = 'ali_app';
	const ALI_CHANNEL_WAP = 'ali_wap';
	const ALI_CHANNEL_WEB = 'ali_web';
	const ALI_CHANNEL_QR = 'ali_qr';
	const ALI_CHANNEL_BAR = 'ali_bar';
	const ALI_CHARGE = 'ali_charge';
	const ALI_REFUND = 'ali_refund';
	const ALI_RED = 'ali_red';
	const ALI_TRANSFER = 'ali_transfer';
	const WX_CHANNEL_APP = 'wx_app';
	const WX_CHANNEL_PUB = 'wx_pub';
	const WX_CHANNEL_QR = 'wx_qr';
	const WX_CHANNEL_BAR = 'wx_bar';
	const WX_CHANNEL_LITE = 'wx_lite';
	const WX_CHANNEL_WAP = 'wx_wap';
	const WX_CHARGE = 'wx_charge';
	const WX_REFUND = 'wx_refund';
	const WX_RED = 'wx_red';
	const WX_TRANSFER = 'wx_transfer';
	const CMB_CHANNEL_APP = 'cmb_app';
	const CMB_CHANNEL_WAP = 'cmb_wap';
	const CMB_BIND = 'cmb_bind';
	const CMB_PUB_KEY = 'cmb_pub_key';
	const CMB_CHARGE = 'cmb_charge';
	const CMB_REFUND = 'cmb_refund';
	const PAY_MIN_FEE = '0.01';
	const TRANS_FEE = '50000';
	const TRADE_STATUS_SUCC = 'success';
	const TRADE_STATUS_FAILD = 'not_pay';
	const WECHAT_PAY = 'wechat';
	const ALI_PAY = 'ali';
	const CMB_PAY = 'cmb';
}


?>
