<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Services;

class UserService
{
	private $orderRepository;
	private $goodsRepository;
	private $userRepository;
	private $addressRepository;
	private $invoiceRepository;
	private $regionRepository;
	private $userBonusRepository;
	private $accountRepository;
	private $collectGoodsRepository;
	private $shopService;
	private $commentRepository;
	private $orderGoodsRepository;

	public function __construct(\App\Repositories\Order\OrderRepository $orderRepository, \App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\User\UserRepository $userRepository, \App\Repositories\User\AddressRepository $addressRepository, \App\Repositories\User\InvoiceRepository $invoiceRepository, \App\Repositories\Region\RegionRepository $regionRepository, \App\Repositories\Bonus\UserBonusRepository $userBonusRepository, \App\Repositories\User\AccountRepository $accountRepository, \App\Repositories\Goods\CollectGoodsRepository $collectGoodsRepository, ShopService $shopService, \App\Repositories\Comment\CommentRepository $commentRepository, \App\Repositories\Order\OrderGoodsRepository $orderGoodsRepository)
	{
		$this->orderRepository = $orderRepository;
		$this->goodsRepository = $goodsRepository;
		$this->userRepository = $userRepository;
		$this->addressRepository = $addressRepository;
		$this->invoiceRepository = $invoiceRepository;
		$this->regionRepository = $regionRepository;
		$this->userBonusRepository = $userBonusRepository;
		$this->accountRepository = $accountRepository;
		$this->collectGoodsRepository = $collectGoodsRepository;
		$this->shopService = $shopService;
		$this->commentRepository = $commentRepository;
		$this->orderGoodsRepository = $orderGoodsRepository;
	}

	public function userCenter(array $args)
	{
		$userId = $args['uid'];
		$result['order']['all_num'] = $this->orderRepository->orderNum($userId);
		$result['order']['no_paid_num'] = $this->orderRepository->orderNum($userId, 0);
		$result['order']['no_received_num'] = $this->orderRepository->orderNum($userId, 2);
		$result['order']['no_evaluation_num'] = $this->orderRepository->orderNum($userId, 3);
		$result['userInfo'] = $this->userRepository->userInfo($userId);
		$bestGoods = $this->goodsRepository->findByType('best');
		$result['best_goods'] = array_map(function($v) {
			return array('goods_id' => $v['goods_id'], 'goods_name' => $v['goods_name'], 'market_price' => $v['market_price'], 'shop_price' => $v['shop_price'], 'goods_thumb' => get_image_path($v['goods_thumb']));
		}, $bestGoods);
		return $result;
	}

	public function orderList($args)
	{
		$orderList = $this->orderRepository->getOrderByUserId($args['uid'], $args['status']);
		$shopconfig = app('App\\Repositories\\ShopConfig\\ShopConfigRepository');
		$timeFormat = $shopconfig->getShopConfigByCode('time_format');

		foreach ($orderList as $k => $v) {
			$orderList[$k]['add_time'] = local_date($timeFormat, $v['add_time']);
			$orderList[$k]['order_status'] = $this->orderStatus($v['order_status']);
			$orderList[$k]['pay_status'] = $this->payStatus($v['pay_status']);
			$orderList[$k]['shipping_status'] = $this->shipStatus($v['shipping_status']);
			$dataTotalNumber = 0;

			foreach ($v['goods'] as $gk => $gv) {
				$dataTotalNumber += $gv['goods_number'];
				$orderList[$k]['goods'][$gk]['goods_thumb'] = get_image_path($gv['goods_thumb']);
				$orderList[$k]['goods'][$gk]['goods_price_formated'] = price_format($gv['goods_price'], false);

				if (empty($orderList[$k]['shop_name'])) {
					$orderList[$k]['shop_name'] = $this->shopService->getShopName($gv['user_id']);
					unset($orderList[$k]['goods'][$gk]['user_id']);
				}
			}

			$orderList[$k]['goods'] = array_slice($orderList[$k]['goods'], 0, 3);
			$orderList[$k]['total_number'] = $dataTotalNumber;
			$orderList[$k]['goods_amount_formated'] = price_format($v['goods_amount']);
			$orderList[$k]['money_paid_formated'] = price_format($v['money_paid']);
			$orderList[$k]['order_amount_formated'] = price_format($v['order_amount']);
			$orderList[$k]['shipping_fee_formated'] = price_format($v['shipping_fee']);
			$orderList[$k]['total_amount'] = $v['money_paid'] + $v['order_amount'] + $v['shipping_fee'];
			$orderList[$k]['total_amount_formated'] = price_format($orderList[$k]['total_amount']);
		}

		return $orderList;
	}

	public function orderDetail($args)
	{
		$order = $this->orderRepository->orderDetail($args['uid'], $args['order_id']);

		if (empty($order)) {
			return array();
		}

		$address = $this->regionRepository->getRegionName($order['country']);
		$address .= $this->regionRepository->getRegionName($order['province']);
		$address .= $this->regionRepository->getRegionName($order['city']);
		$address .= $this->regionRepository->getRegionName($order['district']);
		$address .= $order['address'];
		$shopconfig = app('App\\Repositories\\ShopConfig\\ShopConfigRepository');
		$timeFormat = $shopconfig->getShopConfigByCode('time_format');
		$list = array('add_time' => local_date($timeFormat, $order['add_time']), 'address' => $address, 'consignee' => $order['consignee'], 'mobile' => $order['mobile'], 'money_paid' => $order['money_paid'], 'goods_amount' => $order['goods_amount'], 'goods_amount_formated' => price_format($order['goods_amount'], false), 'order_amount' => $order['order_amount'], 'order_amount_formated' => price_format($order['order_amount'], false), 'order_id' => $order['order_id'], 'order_sn' => $order['order_sn'], 'tax_id' => $order['tax_id'], 'inv_payee' => $order['inv_payee'], 'inv_content' => $order['inv_content'], 'vat_id' => $order['vat_id'], 'invoice_type' => $order['invoice_type'], 'order_status' => $this->orderStatus($order['order_status']), 'pay_status' => $this->payStatus($order['pay_status']), 'shipping_status' => $this->shipStatus($order['shipping_status']), 'pay_time' => $order['pay_time'], 'pay_fee' => $order['pay_fee'], 'pay_fee_formated' => price_format($order['pay_fee'], false), 'pay_name' => $order['pay_name'], 'shipping_fee' => $order['shipping_fee'], 'shipping_fee_formated' => price_format($order['shipping_fee'], false), 'shipping_id' => $order['shipping_id'], 'shipping_name' => $order['shipping_name'], 'total_amount' => $order['order_amount'] + $order['money_paid'] + $order['shipping_fee'], 'total_amount_formated' => price_format($order['order_amount'] + $order['money_paid'] + $order['shipping_fee'], false));

		if (!empty($list)) {
			$orderGoods = $this->orderRepository->getOrderGoods($args['order_id']);
			$goodsList = array();
			$total_number = 0;

			foreach ($orderGoods as $k => $v) {
				$goodsList[$k]['goods_id'] = $v['goods_id'];
				$goodsList[$k]['goods_name'] = $v['goods_name'];
				$goodsList[$k]['goods_number'] = $v['goods_number'];
				$goodsList[$k]['goods_thumb'] = get_image_path($v['goods_thumb']);
				$goodsList[$k]['goods_price'] = $v['goods_price'];
				$goodsList[$k]['goods_price_formated'] = price_format($v['goods_price'], false);
				$goodsList[$k]['goods_sn'] = $v['goods_sn'];
				$goodsList[$k]['shop_name'] = $this->shopService->getShopName($v['ru_id']);
				$total_number += $v['goods_number'];
			}

			$list['goods'] = $goodsList;
			$list['total_number'] = $total_number;
		}

		return $list;
	}

	public function orderAppraise($args)
	{
		$list = $this->orderRepository->getReceived($args['uid']);
		$orders = array();

		foreach ($list as $k => $v) {
			if (empty($v->rec_id)) {
				continue;
			}

			$orders[] = array('id' => $v->goods_id, 'oid' => $v->order_id, 'goods_name' => $v->goods_name, 'shop_price' => $v->goods_price, 'goods_thumb' => get_image_path($v->goods_thumb));
		}

		return $orders;
	}

	public function orderAppraiseDetail($args)
	{
		$list = $this->orderRepository->orderAppraiseDetail($args['uid'], $args['oid'], $args['gid']);

		if (empty($list)) {
			return array();
		}

		$arr = $list['goods'][0];
		$arr['goods_thumb'] = get_image_path($arr['goods_thumb']);
		return $arr;
	}

	public function orderAppraiseAdd($args)
	{
		$orderGoods = $this->orderGoodsRepository->orderGoodsByOidGid($args['oid'], $args['gid']);
		$userInfo = $this->userRepository->userInfo($args['uid']);
		$arr = array('comment_type' => 0, 'id_value' => $args['gid'], 'email' => 'email', 'user_name' => $userInfo['user_name'], 'content' => $args['content'], 'comment_rank' => $args['rank'], 'add_time' => gmtime(), 'ip_address' => app('request')->ip(), 'status' => 1 - app('config')->get('shop.comment_check'), 'parent_id' => 0, 'user_id' => $args['uid'], 'single_id' => 0, 'order_id' => $args['oid'], 'rec_id' => empty($orderGoods) ? 0 : $orderGoods['rec_id'], 'ru_id' => empty($orderGoods) ? 0 : $orderGoods['ru_id']);
		return $this->commentRepository->orderAppraiseAdd($arr);
	}

	public function orderConfirm($args)
	{
		$order = $this->orderRepository->find($args['order_id']);

		if ($order['user_id'] != $args['uid']) {
			return array('code' => 1, 'msg' => '该订单不是本人');
		}
		else if ($order['order_status'] == \App\Models\OrderInfo::OS_CONFIRMED) {
			return array('code' => 1, 'msg' => '订单已确认');
		}
		else if ($order['shipping_status'] == \App\Models\OrderInfo::SS_RECEIVED) {
			return array('code' => 1, 'msg' => '已收货');
		}
		else if ($order['shipping_status'] != \App\Models\OrderInfo::SS_SHIPPED) {
			return array('code' => 1, 'msg' => '订单未发货，不能确认');
		}

		return $this->orderRepository->orderConfirm($args['uid'], $args['order_id']);
	}

	public function orderCancel($args)
	{
		$order = $this->orderRepository->find($args['order_id']);

		if ($order['user_id'] != $args['uid']) {
			return array('error' => 1, 'msg' => '不是本人订单');
		}

		if (($order['order_status'] != \App\Models\OrderInfo::OS_UNCONFIRMED) && ($order['order_status'] != \App\Models\OrderInfo::OS_CONFIRMED)) {
			return array('error' => 1, 'msg' => '订单不能取消');
		}

		if ($order['shipping_status'] != \App\Models\OrderInfo::SS_UNSHIPPED) {
			return array('error' => 1, 'msg' => '订单已确认');
		}

		if ($order['pay_status'] != \App\Models\OrderInfo::PS_UNPAYED) {
			return array('error' => 1, 'msg' => '订单已付款，请与商家联系');
		}

		$res = $this->orderRepository->orderCancel($args['uid'], $args['order_id']);
		return $res;
	}

	private function orderStatus($num)
	{
		$array = array('未确认', '已确认', '已取消', '无效', '退货', '已分单', '部分分单');
		return $array[$num];
	}

	private function payStatus($num)
	{
		$array = array('未付款', '付款中', '已付款');
		return $array[$num];
	}

	private function shipStatus($num)
	{
		$array = array('未发货', '已发货', '已收货', '备货中', '已发货(部分商品)', '发货中(处理分单)', '已发货(部分商品)');
		return $array[$num];
	}

	public function userAddressList($userId)
	{
		$userInfo = $this->userRepository->userInfo($userId);
		$res = $this->addressRepository->addressListByUserId($userId);
		$default = (empty($userInfo['address_id']) ? 0 : $userInfo['address_id']);
		$list = array_map(function($v) use($default) {
			$v['country_name'] = $this->regionRepository->getRegionName($v['country']);
			$v['province_name'] = $this->regionRepository->getRegionName($v['province']);
			$v['city_name'] = $this->regionRepository->getRegionName($v['city']);
			$v['district_name'] = $this->regionRepository->getRegionName($v['district']);
			$v['street_name'] = $this->regionRepository->getRegionName($v['street']);
			$v['id'] = $v['address_id'];
			$v['default'] = $v['address_id'] == $default ? 1 : 0;
			unset($v['country']);
			unset($v['province']);
			unset($v['city']);
			unset($v['district']);
			unset($v['street']);
			unset($v['address_id']);
			unset($v['email']);
			unset($v['address_name']);
			$v['address'] = $v['country_name'] . ' ' . $v['province_name'] . ' ' . $v['city_name'] . ' ' . $v['district_name'] . ' ' . $v['street_name'] . ' ' . $v['address'];
			return $v;
		}, $res);
		return $list;
	}

	public function addressChoice(array $args)
	{
		$res = $this->addressRepository->find($args['id']);
		if (empty($res) || ($args['uid'] != $res['user_id'])) {
			return false;
		}

		return $this->userRepository->setDefaultAddress($args['id'], $args['uid']);
	}

	public function addressAdd(array $args)
	{
		$arr = array('user_id' => $args['uid'], 'consignee' => $args['consignee'], 'email' => '', 'country' => !empty($args['country']) ? $args['country'] : '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['district']) ? $args['district'] : '', 'address' => $args['address'], 'mobile' => isset($args['mobile']) ? $args['mobile'] : '', 'address_name' => '', 'sign_building' => '', 'best_time' => '');
		$res = $this->addressRepository->addAddress($arr);
		return $res;
	}

	public function addressDetail($args)
	{
		$res = $this->addressRepository->find($args['id']);
		if (empty($res) || ($args['uid'] != $res['user_id'])) {
			return false;
		}

		$address = array('id' => $res->address_id, 'consignee' => $res->consignee, 'province_id' => $res->province, 'city_id' => $res->city, 'district_id' => $res->district, 'address' => $res->address, 'mobile' => $res->mobile);
		$provinceList = $this->regionRepository->getRegionByParentId();
		$cityList = $this->regionRepository->getRegionByParentId($address['province_id']);
		$districtList = $this->regionRepository->getRegionByParentId($address['city_id']);
		return array('address' => $address, 'province' => $provinceList, 'city' => $cityList, 'district' => $districtList);
	}

	public function addressUpdate($args)
	{
		$arr = array('user_id' => $args['uid'], 'consignee' => $args['consignee'], 'email' => '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['district']) ? $args['district'] : '', 'address' => $args['address'], 'mobile' => isset($args['mobile']) ? $args['mobile'] : '', 'address_name' => '', 'sign_building' => '', 'best_time' => '');
		$res = $this->addressRepository->updateAddress($args['id'], $arr);
		return (int) $res;
	}

	public function addressDelete($args)
	{
		$res = $this->addressRepository->deleteAddress($args['id'], $args['uid']);
		return $res;
	}

	public function userAccount($userId)
	{
		$userInfo = $this->userRepository->userInfo($userId);

		if (empty($userInfo)) {
			return array();
		}

		$result['user_money'] = $userInfo['user_money'];
		$result['frozen_money'] = $userInfo['frozen_money'];
		$result['pay_points'] = $userInfo['pay_points'];
		$result['bonus_num'] = $this->userBonusRepository->getUserBonusCount($userId);
		return $result;
	}

	public function accountDetail($args)
	{
		$list = $this->accountRepository->accountList($args['user_id'], $args['page'], $args['size']);
		$accountList = array_map(function($v) {
			return array('log_sn' => $v['log_id'], 'money' => $v['user_money'], 'time' => $v['change_time']);
		}, $list);
		return $accountList;
	}

	public function accountLog($args)
	{
		$list = $this->accountRepository->accountLogList($args['user_id'], $args['page'], $args['size']);
		$logList = array_map(function($v) {
			return array('log_sn' => $v['id'], 'money' => $v['amount'], 'time' => $v['add_time'], 'type' => $v['process_type'] == 0 ? '充值' : '提现', 'status' => $v['is_paid'] == 0 ? '未支付' : '已支付');
		}, $list);
		return $logList;
	}

	public function deposit($args)
	{
		$arr = array('user_id' => $args['uid'], 'amount' => $args['amount'], 'add_time' => gmtime(), 'user_note' => $args['user_note'], 'payment' => $args['payment']);
		return $this->accountRepository->deposit($arr);
	}

	public function collectGoods($args)
	{
		$list = $this->collectGoodsRepository->findByUserId($args['user_id'], $args['page'], $args['size']);
		$collect = array_map(function($v) {
			$goodsInfo = $this->goodsRepository->goodsInfo($v['goods_id']);
			return array('goods_name' => $goodsInfo['goods_name'], 'shop_price' => $goodsInfo['goods_price'], 'goods_thumb' => get_image_path($goodsInfo['goods_thumb']), 'goods_stock' => $goodsInfo['stock'], 'time' => $v['add_time'], 'goods_id' => $v['goods_id']);
		}, $list);
		return $collect;
	}

	public function collectAdd($args)
	{
		$collectGoods = $this->collectGoodsRepository->findOne($args['id'], $args['uid']);

		if (empty($collectGoods)) {
			$result = $this->collectGoodsRepository->addCollectGoods($args['id'], $args['uid']);
		}
		else {
			$result = $this->collectGoodsRepository->deleteCollectGoods($args['id'], $args['uid']);
		}

		return $result;
	}

	public function myConpont($args)
	{
		$list = array();
		return $list;
	}

	public function invoiceAdd(array $args)
	{
		$invoice = $this->invoiceRepository->find($args['uid']);

		if (!empty($invoice)) {
			return false;
		}

		$arr = array('user_id' => $args['uid'], 'company_name' => $args['company_name'], 'company_address' => $args['company_address'], 'tax_id' => $args['tax_id'], 'company_telephone' => $args['company_telephone'], 'bank_of_deposit' => $args['bank_of_deposit'], 'bank_account' => $args['bank_account'], 'consignee_name' => $args['consignee_name'], 'consignee_mobile_phone' => $args['consignee_mobile_phone'], 'country' => !empty($args['country']) ? $args['country'] : '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['district']) ? $args['district'] : '', 'consignee_address' => $args['consignee_address'], 'audit_status' => 0, 'add_time' => gmtime());
		$res = $this->invoiceRepository->addInvoice($arr);
		return $res;
	}

	public function invoiceUpdate($args)
	{
		$arr = array('user_id' => $args['uid'], 'company_name' => $args['company_name'], 'company_address' => $args['company_address'], 'tax_id' => $args['tax_id'], 'company_telephone' => $args['company_telephone'], 'bank_of_deposit' => $args['bank_of_deposit'], 'bank_account' => $args['bank_account'], 'consignee_name' => $args['consignee_name'], 'consignee_mobile_phone' => $args['consignee_mobile_phone'], 'country' => !empty($args['country']) ? $args['country'] : '', 'province' => !empty($args['province']) ? $args['province'] : '', 'city' => !empty($args['city']) ? $args['city'] : '', 'district' => !empty($args['district']) ? $args['district'] : '', 'consignee_address' => $args['consignee_address'], 'audit_status' => 0, 'add_time' => gmtime());
		$res = $this->invoiceRepository->updateInvoice($args['id'], $arr);
		return (int) $res;
	}

	public function invoiceDetail(array $args)
	{
		$res = $this->invoiceRepository->find($args['uid']);
		if (empty($res) || ($args['uid'] != $res['user_id'])) {
			return false;
		}

		$invoice = array('id' => $res->id, 'company_name' => $res->company_name, 'company_address' => $res->company_address, 'tax_id' => $res->tax_id, 'company_telephone' => $res->company_telephone, 'bank_of_deposit' => $res->bank_of_deposit, 'bank_account' => $res->bank_account, 'consignee_name' => $res->consignee_name, 'consignee_mobile_phone' => $res->consignee_mobile_phone, 'consignee_address' => $res->consignee_address, 'country' => $res->country, 'province' => $res->province, 'city' => $res->city, 'district' => $res->district, 'audit_status' => $res->audit_status);
		$provinceList = $this->regionRepository->getRegionByParentId();
		$cityList = $this->regionRepository->getRegionByParentId($invoice['province_id']);
		$districtList = $this->regionRepository->getRegionByParentId($invoice['city_id']);
		return array('address' => $invoice, 'province' => $provinceList, 'city' => $cityList, 'district' => $districtList);
	}

	public function invoiceDelete($args)
	{
		$res = $this->invoiceRepository->deleteInvoice($args['id'], $args['uid']);
		return $res;
	}
}


?>
