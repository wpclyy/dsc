<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Common\Weixin\Data;

class BackAppChargeData extends WxBaseData
{
	protected function buildData()
	{
		$this->retData = array('appid' => $this->appId, 'partnerid' => $this->mchId, 'prepayid' => $this->prepay_id, 'package' => 'Sign=WXPay', 'noncestr' => $this->nonceStr, 'timestamp' => time());
	}

	protected function checkDataParam()
	{
	}
}

?>
