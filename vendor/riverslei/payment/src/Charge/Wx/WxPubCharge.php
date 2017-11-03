<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Charge\Wx;

class WxPubCharge extends \Payment\Common\Weixin\WxBaseStrategy
{
	public function getBuildDataClass()
	{
		$this->config->tradeType = 'JSAPI';
		return 'Payment\\Common\\Weixin\\Data\\Charge\\PubChargeData';
	}

	protected function retData(array $ret)
	{
		$back = new \Payment\Common\Weixin\Data\BackPubChargeData($this->config, $ret);
		$back->setSign();
		$backData = $back->getData();
		$backData['paySign'] = $backData['sign'];
		unset($backData['sign']);
		return $backData;
	}
}

?>
