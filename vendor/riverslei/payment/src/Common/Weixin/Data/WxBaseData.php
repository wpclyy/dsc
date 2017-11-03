<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Payment\Common\Weixin\Data;

abstract class WxBaseData extends \Payment\Common\BaseData
{
	protected function makeSign($signStr)
	{
		switch ($this->signType) {
		case 'MD5':
			$signStr .= '&key=' . $this->md5Key;
			$sign = md5($signStr);
			break;

		case 'HMAC-SHA256':
			$sign = base64_encode(hash_hmac('sha256', $signStr, $this->md5Key));
			break;

		default:
			$sign = '';
		}

		return strtoupper($sign);
	}
}

?>
