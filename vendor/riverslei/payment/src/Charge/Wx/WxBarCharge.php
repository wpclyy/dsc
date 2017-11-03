<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Charge\Wx;

class WxBarCharge extends \Payment\Common\Weixin\WxBaseStrategy
{
	public function getBuildDataClass()
	{
		return 'Payment\\Common\\Weixin\\Data\\Charge\\BarChargeData';
	}

	protected function getReqUrl()
	{
		return \Payment\Common\WxConfig::MICROPAY_URL;
	}

	protected function retData(array $ret)
	{
		$ret['total_fee'] = bcdiv($ret['total_fee'], 100, 2);
		$ret['cash_fee'] = bcdiv($ret['cash_fee'], 100, 2);

		if ($this->config->returnRaw) {
			return $ret;
		}

		return $ret;
	}
}

?>
