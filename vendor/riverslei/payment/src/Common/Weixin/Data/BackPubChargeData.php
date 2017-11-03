<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Common\Weixin\Data;

class BackPubChargeData extends WxBaseData
{
	protected function buildData()
	{
		$this->retData = array('appId' => $this->appId, 'timeStamp' => time() . '', 'nonceStr' => $this->nonceStr, 'package' => 'prepay_id=' . $this->prepay_id, 'signType' => 'MD5');
	}

	protected function checkDataParam()
	{
	}
}

?>
