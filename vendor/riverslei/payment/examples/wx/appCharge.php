<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
require_once __DIR__ . '/../../autoload.php';
date_default_timezone_set('Asia/Shanghai');
$wxConfig = require_once __DIR__ . '/../wxconfig.php';
$orderNo = time() . rand(1000, 9999);
$payData = array('body' => 'test body', 'subject' => 'test subject', 'order_no' => $orderNo, 'timeout_express' => time() + 600, 'amount' => '3.01', 'return_param' => '123', 'client_ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1');

try {
	$ret = \Payment\Client\Charge::run(\Payment\Config::WX_CHANNEL_APP, $wxConfig, $payData);
}
catch (\Payment\Common\PayException $e) {
	echo $e->errorMessage();
	exit();
}

echo json_encode($ret, JSON_UNESCAPED_UNICODE);

?>
