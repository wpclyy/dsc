<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Services;

class FlowService
{
	const CART_GENERAL_GOODS = 0;
	const SDT_SHIP = 0;
	const SDT_PLACE = 1;

	private $cartRepository;
	private $addressRepository;
	private $invoiceRepository;
	private $paymentRepository;
	private $shippingRepository;
	private $shopConfigRepository;
	private $goodsRepository;
	private $productRepository;
	private $orderRepository;
	private $orderGoodsRepository;
	private $orderInvoiceRepository;
	private $accountRepository;
	private $payLogRepository;
	private $regionRepository;

	public function __construct(\App\Repositories\Cart\CartRepository $cartRepository, \App\Repositories\User\AddressRepository $addressRepository, \App\Repositories\User\InvoiceRepository $invoiceRepository, \App\Repositories\Payment\PaymentRepository $paymentRepository, \App\Repositories\Shipping\ShippingRepository $shippingRepository, \App\Repositories\ShopConfig\ShopConfigRepository $shopConfigRepository, \App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\Order\OrderInvoiceRepository $orderInvoiceRepository, \App\Repositories\Product\ProductRepository $productRepository, \App\Repositories\Order\OrderRepository $orderRepository, \App\Repositories\Order\OrderGoodsRepository $orderGoodsRepository, \App\Repositories\User\AccountRepository $accountRepository, \App\Repositories\Payment\PayLogRepository $payLogRepository, \App\Repositories\Region\RegionRepository $regionRepository)
	{
		$this->cartRepository = $cartRepository;
		$this->addressRepository = $addressRepository;
		$this->invoiceRepository = $invoiceRepository;
		$this->paymentRepository = $paymentRepository;
		$this->shippingRepository = $shippingRepository;
		$this->shopConfigRepository = $shopConfigRepository;
		$this->goodsRepository = $goodsRepository;
		$this->productRepository = $productRepository;
		$this->orderRepository = $orderRepository;
		$this->orderGoodsRepository = $orderGoodsRepository;
		$this->orderInvoiceRepository = $orderInvoiceRepository;
		$this->accountRepository = $accountRepository;
		$this->payLogRepository = $payLogRepository;
		$this->regionRepository = $regionRepository;
	}

	public function flowInfo($userId)
	{
		$result = array();
		$result['cart_goods_list'] = $this->arrangeCartGoods($userId);

		if ($this->shopConfigRepository->getShopConfigByCode('can_invoice') == '1') {
			$result['invoice_content'] = explode("\n", str_replace("\r", '', $this->shopConfigRepository->getShopConfigByCode('invoice_content')));

			if (!$this->invoiceRepository->find($userId)) {
				$result['vat_invoice'] = '';
			}
			else {
				$result['vat_invoice'] = $this->invoiceRepository->find($userId);
			}

			$result['can_invoice'] = 1;
		}
		else {
			$result['can_invoice'] = 0;
		}

		$defaultAddress = $this->addressRepository->getDefaultByUserId($userId);
		if (empty($defaultAddress['province']) || empty($defaultAddress['city'])) {
			$result['default_address'] = '';
		}
		else {
			$result['default_address'] = array('country' => $this->regionRepository->getRegionName($defaultAddress['country']), 'province' => $this->regionRepository->getRegionName($defaultAddress['province']), 'city' => $this->regionRepository->getRegionName($defaultAddress['city']), 'district' => $this->regionRepository->getRegionName($defaultAddress['district']), 'address' => $defaultAddress['address'], 'address_id' => $defaultAddress['address_id'], 'consignee' => $defaultAddress['consignee'], 'mobile' => $defaultAddress['mobile'], 'user_id' => $defaultAddress['user_id']);
		}

		return $result;
	}

	private function arrangeCartGoods($userId)
	{
		$cartGoodsList = $this->cartRepository->getGoodsInCartByUser($userId);
		$list = array();
		$totalAmount = $cartGoodsList['total']['goods_price'];

		foreach ($cartGoodsList['goods_list'] as $k => $v) {
			if (!isset($total[$v['ru_id']])) {
				$total[$v['ru_id']] = 0;
			}

			$totalPrice = (empty($total[$v['ru_id']]['price']) ? 0 : $total[$v['ru_id']]['price']);
			$totalNumber = (empty($total[$v['ru_id']]['number']) ? 0 : $total[$v['ru_id']]['number']);

			foreach ($v['goods'] as $key => $value) {
				$totalPrice += $value['goods_price'] * $value['goods_number'];
				$totalNumber += $value['goods_number'];
				$list[$v['ru_id']]['shop_list'][$key] = array('rec_id' => $value['rec_id'], 'user_id' => $v['user_id'], 'goods_id' => $value['goods_id'], 'goods_name' => $value['goods_name'], 'ru_id' => $v['ru_id'], 'shop_name' => $v['shop_name'], 'market_price' => strip_tags($value['market_price']), 'market_price_formated' => price_format($value['market_price'], false), 'goods_price' => strip_tags($value['goods_price']), 'goods_price_formated' => price_format($value['goods_price'], false), 'goods_number' => $value['goods_number'], 'goods_thumb' => get_image_path($value['goods_thumb']), 'goods_attr' => $value['goods_attr']);
			}

			foreach ($v['shop_info'] as $key => $value) {
				$list[$v['ru_id']]['shop_info'][$key] = array('shipping_id' => $value['shipping_id'], 'shipping_name' => $value['shipping_name'], 'ru_id' => $value['ru_id']);
			}

			$list[$v['ru_id']]['total'] = array('price' => $totalPrice, 'price_formated' => price_format($totalPrice, false), 'number' => $totalNumber);
		}

		unset($cartGoodsList);
		$totalAmount = strip_tags(preg_replace('/([\\x80-\\xff]*|[a-zA-Z])/i', '', $totalAmount));
		sort($list);
		return array('list' => $list, 'order_total' => $totalAmount, 'order_total_formated' => price_format($totalAmount, false));
	}

	public function submitOrder($args)
	{
		$userId = $args['uid'];
		app('config')->set('uid', $userId);
		$flow_type = self::CART_GENERAL_GOODS;
		$goodsNum = $this->cartRepository->goodsNumInCartByUser($userId);

		if (empty($goodsNum)) {
			return array('error' => 1, 'msg' => '购物车没有商品');
		}

		if (($this->shopConfigRepository->getShopConfigByCode('use_storage') == 1) && ($this->shopConfigRepository->getShopConfigByCode('stock_dec_time') == 1)) {
			$cart_goods = $this->cartRepository->getGoodsInCartByUser($userId);
			$_cart_goods_stock = array();

			foreach ($cart_goods['goods_list'] as $value) {
				foreach ($value['goods'] as $goodsValue) {
					$_cart_goods_stock[$goodsValue['rec_id']] = $goodsValue['goods_number'];
				}
			}

			if (!$this->flow_cart_stock($_cart_goods_stock)) {
				return array('error' => 1, 'msg' => '库存不足');
			}

			unset($cart_goods_stock);
			unset($_cart_goods_stock);
		}

		$consignee = $args['consignee'];
		$consignee_info = $this->addressRepository->find($consignee);

		if (empty($consignee_info)) {
			return array('error' => 1, 'msg' => 'not find consignee');
		}

		$shipping = $this->generateShipping($args['shipping']);
		$order = array('shipping_id' => empty($shipping['shipping_id']) ? 0 : $shipping['shipping_id'], 'pay_id' => intval(0), 'surplus' => isset($args['surplus']) ? floatval($args['surplus']) : 0, 'integral' => isset($score) ? intval($score) : 0, 'tax_id' => empty($args['postdata']['tax_id']) ? 0 : $args['postdata']['tax_id'], 'inv_payee' => trim($args['postdata']['inv_payee']), 'inv_content' => !trim($args['postdata']['inv_content']) ? 0 : trim($args['postdata']['inv_content']), 'vat_id' => empty($args['postdata']['vat_id']) ? 0 : $args['postdata']['vat_id'], 'invoice_type' => empty($args['postdata']['invoice_type']) ? 0 : $args['postdata']['invoice_type'], 'froms' => '微信小程序', 'postscript' => @trim($args['postscript']), 'how_oos' => '', 'user_id' => $userId, 'add_time' => gmtime(), 'order_status' => \App\Models\OrderInfo::OS_UNCONFIRMED, 'shipping_status' => \App\Models\OrderInfo::SS_UNSHIPPED, 'pay_status' => \App\Models\OrderInfo::PS_UNPAYED, 'agency_id' => 0);
		$order['extension_code'] = '';
		$order['extension_id'] = 0;

		if (!isset($cart_goods)) {
			$cart_goods = $this->cartRepository->getGoodsInCartByUser($userId);
		}

		$cartGoods = $cart_goods['goods_list'];
		$cart_good_ids = array();

		foreach ($cartGoods as $k => $v) {
			foreach ($v['goods'] as $goodsValue) {
				array_push($cart_good_ids, $goodsValue['rec_id']);
			}
		}

		if (empty($cart_goods)) {
			return array('error' => 1, 'msg' => '购物车没有商品');
		}

		$order['consignee'] = $consignee_info->consignee;
		$order['country'] = $consignee_info->country;
		$order['province'] = $consignee_info->province;
		$order['city'] = $consignee_info->city;
		$order['mobile'] = $consignee_info->mobile;
		$order['tel'] = $consignee_info->tel;
		$order['zipcode'] = $consignee_info->zipcode;
		$order['district'] = $consignee_info->district;
		$order['address'] = $consignee_info->address;

		foreach ($cartGoods as $val) {
			foreach ($val['goods'] as $v) {
				if ($v['is_real']) {
					$is_real_good = 1;
				}
			}
		}

		$total = $this->orderRepository->order_fee($order, $cart_goods['goods_list'], $consignee_info, $cart_good_ids, $order['shipping_id'], $consignee);
		$order['bonus'] = isset($bonus) ? $bonus['type_money'] : '';
		$order['goods_amount'] = $total['goods_price'];
		$order['discount'] = $total['discount'];
		$order['surplus'] = $total['surplus'];
		$order['tax'] = $total['tax'];

		if (!empty($order['shipping_id'])) {
			$order['shipping_name'] = addslashes($shipping['shipping_name']);
		}

		$order['shipping_fee'] = $total['shipping_fee'];
		$order['insure_fee'] = 0;

		if (0 < $order['pay_id']) {
			$order['pay_name'] = '微信支付';
		}

		$order['pay_name'] = '微信支付';
		$order['pay_fee'] = $total['pay_fee'];
		$order['cod_fee'] = $total['cod_fee'];
		$order['order_amount'] = number_format($total['amount'], 2, '.', '');

		if ($order['order_amount'] <= 0) {
			$order['order_status'] = \App\Models\OrderInfo::OS_CONFIRMED;
			$order['confirm_time'] = gmtime();
			$order['pay_status'] = \App\Models\OrderInfo::PS_PAYED;
			$order['pay_time'] = gmtime();
			$order['order_amount'] = 0;
		}

		$order['integral_money'] = $total['integral_money'];
		$order['integral'] = $total['integral'];
		$order['parent_id'] = 0;
		$order['order_sn'] = $this->getOrderSn();
		unset($order['timestamps']);
		unset($order['perPage']);
		unset($order['incrementing']);
		unset($order['dateFormat']);
		unset($order['morphClass']);
		unset($order['exists']);
		unset($order['wasRecentlyCreated']);
		unset($order['cod_fee']);
		$order['bonus'] = !empty($order['bonus']) ? $order['bonus'] : (!empty($order['bonus_id']) ? $order['bonus_id'] : 0);
		$new_order_id = $this->orderRepository->insertGetId($order);
		$order['order_id'] = $new_order_id;
		$newGoodsList = array();

		foreach ($cartGoods as $v) {
			foreach ($v['goods'] as $gv) {
				$gv['ru_id'] = $v['ru_id'];
				$gv['user_id'] = $v['user_id'];
				$gv['shop_name'] = $v['shop_name'];
				$newGoodsList[] = $gv;
			}
		}

		$this->orderGoodsRepository->insertOrderGoods($newGoodsList, $order['order_id']);
		if ((0 < $order['user_id']) && (0 < $order['integral'])) {
			$this->accountRepository->logAccountChange(0, 0, 0, $order['integral'] * -1, trans('message.score.pay'), $order['order_sn'], $userId);
		}

		if (($this->shopConfigRepository->getShopConfigByCode('use_storage') == '1') && ($this->shopConfigRepository->getShopConfigByCode('stock_dec_time') == self::SDT_PLACE)) {
			$this->orderRepository->changeOrderGoodsStorage($order['order_id'], true, self::SDT_PLACE);
		}

		$this->clear_cart_ids($cart_good_ids, $flow_type);
		$order['log_id'] = $this->payLogRepository->insert_pay_log($new_order_id, $order['order_amount'], 0);
		$user_invoice = $this->orderInvoiceRepository->find($userId);
		$invoice_info = array('tax_id' => $order['tax_id'], 'inv_payee' => $order['inv_payee'], 'user_id' => $userId);

		if (!empty($user_invoice)) {
			$this->orderInvoiceRepository->updateInvoice($user_invoice['invoice_id'], $invoice_info);
		}
		else {
			$this->orderInvoiceRepository->addInvoice($invoice_info);
		}

		$order_id = $order['order_id'];
		$shipping = array('shipping' => $args['shipping'], 'shipping_fee_list' => $total['shipping_fee_list']);
		$this->childOrder($cart_goods, $order, $consignee_info, $shipping);
		return $order_id;
	}

	private function generateShipping($arr)
	{
		$return = array();
		$str = array();

		foreach ($arr as $k => $v) {
			$return[] = implode('|', array_values($v));
			$shippingId = $v['shipping_id'];
			$shipping = $this->shippingRepository->find($shippingId);
			$str[] = implode('|', array($v['ru_id'], $shipping['shipping_name']));
		}

		return array('shipping_id' => implode(',', $return), 'shipping_name' => implode(',', $str));
	}

	private function childOrder($cartGoods, $order, $consigneeInfo, $shipping)
	{
		$goodsList = $cartGoods['goods_list'];
		$total = $cartGoods['total'];
		$orderGoods = array();
		$ruIds = $this->getRuIds($goodsList);

		if (count($ruIds) <= 0) {
			return NULL;
		}

		$newShippingArr = array();

		foreach ($shipping['shipping'] as $v) {
			$newShippingArr[$v['ru_id']] = $v['shipping_id'];
		}

		$newShippingFeeArr = array();

		foreach ($shipping['shipping_fee_list'] as $k => $v) {
			$newShippingFeeArr[$k] = $v;
		}

		$newShippingName = explode(',', $order['shipping_name']);
		$newShippingNameArr = array();

		foreach ($newShippingName as $v) {
			$temp = explode('|', $v);
			$newShippingNameArr[$temp[0]] = $temp[1];
		}

		foreach ($goodsList as $key => $value) {
			$userId = 0;
			$goodsAmount = 0;
			$orderAmount = 0;
			$newOrder = array();
			$orderGoods = array();

			foreach ($value['goods'] as $v) {
				if ($v['ru_id'] != $value['ru_id']) {
					continue;
				}

				$userId = $value['user_id'];
				$goodsAmount += $v['goods_number'] * $v['goods_price'];
				$orderAmount += $v['goods_number'] * $v['goods_price'];
			}

			$newOrder = array('main_order_id' => $order['order_id'], 'order_sn' => $this->getOrderSn(), 'user_id' => $userId, 'shipping_id' => $newShippingArr[$value['ru_id']], 'shipping_name' => $newShippingNameArr[$value['ru_id']], 'shipping_fee' => $newShippingFeeArr[$value['ru_id']], 'pay_id' => $order['pay_id'], 'pay_name' => '微信支付', 'goods_amount' => $goodsAmount, 'order_amount' => $orderAmount, 'add_time' => gmtime(), 'order_status' => $order['order_status'], 'shipping_status' => $order['shipping_status'], 'pay_status' => $order['pay_status'], 'tax_id' => $order['tax_id'], 'inv_payee' => $order['inv_payee'], 'inv_content' => $order['inv_content'], 'vat_id' => $order['vat_id'], 'invoice_type' => $order['invoice_type'], 'froms' => '微信小程序', 'consignee' => $consigneeInfo->consignee, 'country' => $consigneeInfo->country, 'province' => $consigneeInfo->province, 'city' => $consigneeInfo->city, 'mobile' => $consigneeInfo->mobile, 'tel' => $consigneeInfo->tel, 'zipcode' => $consigneeInfo->zipcode, 'district' => $consigneeInfo->district, 'address' => $consigneeInfo->address);
			$new_order_id = $this->orderRepository->insertGetId($newOrder);

			foreach ($value['goods'] as $v) {
				if ($v['ru_id'] != $value['ru_id']) {
					continue;
				}

				$orderGoods[] = array('order_id' => $new_order_id, 'goods_id' => $v['goods_id'], 'goods_name' => $v['goods_name'], 'goods_sn' => $v['goods_sn'], 'product_id' => $v['product_id'], 'goods_number' => $v['goods_number'], 'market_price' => $v['market_price'], 'goods_price' => $v['goods_price'], 'goods_attr' => $v['goods_attr'], 'is_real' => $v['is_real'], 'extension_code' => $v['extension_code'], 'parent_id' => $v['parent_id'], 'is_gift' => $v['is_gift'], 'model_attr' => $v['model_attr'], 'goods_attr_id' => $v['goods_attr_id'], 'ru_id' => $v['ru_id'], 'shopping_fee' => $v['shopping_fee'], 'warehouse_id' => $v['warehouse_id'], 'area_id' => $v['area_id']);
			}

			$this->orderGoodsRepository->insertOrderGoods($orderGoods);
		}
	}

	private function getRuIds($cartGoods)
	{
		$arr = array();

		foreach ($cartGoods as $v) {
			if (in_array($v['ru_id'], $arr)) {
				continue;
			}

			$arr[] = $v['ru_id'];
		}

		return $arr;
	}

	public function flow_cart_stock($arr)
	{
		foreach ($arr as $key => $val) {
			$val = intval(make_semiangle($val));
			if (($val <= 0) || !is_numeric($key)) {
				continue;
			}

			$goods = $this->cartRepository->field(array('goods_id', 'goods_attr_id', 'extension_code'))->find($key);
			$row = $this->goodsRepository->cartGoods($key);
			$goodsExtendsionCode = (empty($goods['extension_code']) ? '' : $goods['extension_code']);
			if ((0 < intval($this->shopConfigRepository->getShopConfigByCode('use_storage'))) && ($goodsExtendsionCode != 'package_buy')) {
				if ($row['goods_number'] < $val) {
					return false;
				}

				$row['product_id'] = trim($row['product_id']);

				if (!empty($row['product_id'])) {
					@$product_number = $this->productRepository->findBy(array('goods_id' => $goods['goods_id'], 'product_id' => $row['product_id']))->column('product_number');

					if ($product_number < $val) {
						return false;
					}
				}
			}
		}

		return true;
	}

	public function getOrderSn()
	{
		mt_srand((double) microtime() * 1000000);
		return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
	}

	private function clear_cart_ids($arr, $type = self::CART_GENERAL_GOODS)
	{
		$uid = app('config')->get('uid');
		$this->cartRepository->deleteAll(array(
	array('in', 'rec_id', $arr),
	array('rec_type', $type),
	array('user_id', $uid)
	));
	}

	public function shippingFee($args)
	{
		$result = array('error' => 0, 'message' => '');
		$shippingId = (isset($args['id']) ? intval($args['id']) : 0);
		$ruId = (isset($args['ru_id']) ? intval($args['ru_id']) : 0);
		$address = (isset($args['address']) ? intval($args['address']) : 0);
		$cart_goods = $this->cartRepository->getGoodsInCartByUser($args['uid']);
		$cart_goods_list = $cart_goods['product'];

		if (empty($cart_goods_list)) {
			$result['error'] = 1;
			$result['message'] = '购物车没有商品';
			return $result;
		}

		foreach ($cart_goods_list as $key => $val) {
			if ((0 < $shippingId) && ($val['goods']['ru_id'] == $ruId)) {
				$cart_goods_list[$key]['goods']['tmp_shipping_id'] = $shippingId;
			}
		}

		$shipFee = $this->shippingRepository->total_shipping_fee($address, $cart_goods_list, $shippingId, $ruId);

		if ($shipFee) {
			$newShipFee = strip_tags(preg_replace('/([\\x80-\\xff]*|[a-zA-Z])/i', '', $shipFee));
			$result['fee'] = '0';

			if (0 < floatval($newShipFee)) {
				$result['fee'] = $newShipFee;
			}
		}
		else {
			$result['error'] = 1;
			$result['message'] = '该地区不支持配送';
		}

		$result['fee_formated'] = $shipFee;
		return $result;
	}
}


?>
