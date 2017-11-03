<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Common\Cmb\Data;

class PubKeyData extends CmbBaseData
{
	protected function getReqData()
	{
		$reqData = array('dateTime' => $this->dateTime, 'branchNo' => $this->branchNo, 'merchantNo' => $this->merchantNo, 'txCode' => \Payment\Common\CmbConfig::TRADE_CODE);
		return $reqData;
	}
}

?>
