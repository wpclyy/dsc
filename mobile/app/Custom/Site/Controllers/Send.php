<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace App\Custom\Site\Controllers;

class Send extends \App\Http\Site\Controllers\Index
{
	public function actionTest()
	{
		$message = array('code' => '1234', 'product' => 'sitename');
		$res = send_sms('18801828888', 'sms_signin', $message);

		if ($res !== true) {
			exit($res);
		}

		$res = send_mail('xxx', 'wanglin@ecmoban.com', 'title', 'content');

		if ($res !== true) {
			exit($res);
		}
	}
}

?>
