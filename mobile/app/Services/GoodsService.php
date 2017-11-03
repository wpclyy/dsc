<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Services;

class GoodsService
{
	private $goodsRepository;
	private $goodsAttrRepository;
	private $collectGoodsRepository;
	private $shopService;
	private $cartRepository;

	public function __construct(\App\Repositories\Goods\GoodsRepository $goodsRepository, \App\Repositories\Goods\GoodsAttrRepository $goodsAttrRepository, \App\Repositories\Goods\CollectGoodsRepository $collectGoodsRepository, ShopService $shopService, \App\Repositories\Cart\CartRepository $cartRepository)
	{
		$this->goodsRepository = $goodsRepository;
		$this->goodsAttrRepository = $goodsAttrRepository;
		$this->collectGoodsRepository = $collectGoodsRepository;
		$this->shopService = $shopService;
		$this->cartRepository = $cartRepository;
	}

	public function getGoodsList($categoryId = 0, $keywords = '', $page = 1, $size = 10, $sortKey = '', $sortVal = '')
	{
		$page = (empty($page) ? 1 : $page);
		$field = array('goods_id', 'goods_name', 'shop_price', 'goods_thumb', 'goods_number', 'market_price', 'sales_volume');
		$list = $this->goodsRepository->findBy('category', $categoryId, $page, $size, $field, $keywords, $sortKey, $sortVal);

		foreach ($list as $k => $v) {
			$list[$k]['goods_thumb'] = get_image_path($v['goods_thumb']);
			$list[$k]['market_price_formated'] = price_format($v['market_price'], false);
			$list[$k]['shop_price_formated'] = price_format($v['shop_price'], false);
		}

		return $list;
	}

	public function goodsDetail($id, $uid)
	{
		$result = array('error' => 0, 'goods_img' => '', 'goods_info' => '', 'goods_comment' => '', 'goods_properties' => '');
		$rootPath = app('request')->root();
		$rootPath = dirname(dirname($rootPath)) . '/';
		$shopconfig = app('App\\Repositories\\ShopConfig\\ShopConfigRepository');
		$timeFormat = $shopconfig->getShopConfigByCode('time_format');
		$collect = $this->collectGoodsRepository->findOne($id, $uid);
		$goodsComment = $this->goodsRepository->goodsComment($id);

		foreach ($goodsComment as $k => $v) {
			$goodsComment[$k]['add_time'] = local_date('Y-m-d', $v['add_time']);
			$goodsComment[$k]['user_name'] = $this->goodsRepository->getGoodsCommentUser($v['user_id']);
		}

		$result['goods_comment'] = $goodsComment;
		$result['total_comment_number'] = count($result['goods_comment']);
		$goodsInfo = $this->goodsRepository->goodsInfo($id);

		if ($goodsInfo['is_on_sale'] == 0) {
			return array('error' => 1, 'msg' => '商品已下架');
		}

		$goodsInfo['goods_thumb'] = get_image_path($goodsInfo['goods_thumb']);
		$goodsInfo['goods_price_formated'] = price_format($goodsInfo['goods_price'], true);
		$goodsInfo['market_price_formated'] = price_format($goodsInfo['market_price'], true);
		$result['goods_info'] = array_merge($goodsInfo, array('is_collect' => empty($collect) ? 0 : 1));
		$ruId = $goodsInfo['user_id'];
		unset($result['goods_info']['user_id']);
		$result['shop_name'] = $this->shopService->getShopName($ruId);
		$goodsGallery = $this->goodsRepository->goodsGallery($id);

		foreach ($goodsGallery as $k => $v) {
			$goodsGallery[$k] = get_image_path($v['thumb_url']);
		}

		$result['goods_img'] = $goodsGallery;
		$result['goods_properties'] = $this->goodsRepository->goodsProperties($id);
		$result['cart_number'] = $this->cartRepository->goodsNumInCartByUser($uid);
		$result['root_path'] = $rootPath;
		return $result;
	}

	public function goodsPropertiesPrice($goods_id, $attr_id, $num = 1, $warehouse_id = 0, $area_id = 0)
	{
		$result = array('stock' => '', 'market_price' => '', 'qty' => '', 'spec_price' => '', 'goods_price' => '', 'attr_img' => '');
		$goods = $this->goodsRepository->goodsInfo($goods_id);
		$result['stock'] = $this->goodsRepository->goodsAttrNumber($goods_id, $attr_id, $warehouse_id, $area_id);
		$result['market_price'] = $goods['market_price'];
		$result['market_price_formated'] = price_format($goods['market_price'], true);
		$result['qty'] = $num;
		$result['spec_price'] = $this->goodsRepository->goodsPropertyPrice($goods_id, $attr_id, $warehouse_id, $area_id);
		$result['spec_price_formated'] = price_format($result['spec_price'], true);
		$result['goods_price'] = $this->goodsRepository->getFinalPrice($goods_id, $num, true, $attr_id, $warehouse_id, $area_id);
		$result['goods_price_formated'] = price_format($result['goods_price'], true);
		$attr_img = $this->goodsRepository->getAttrImgFlie($goods_id, $attr_id);

		if (!empty($attr_img)) {
			$result['attr_img'] = get_image_path($attr_img['attr_img_flie']);
		}

		return $result;
	}
}


?>
