<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
function customSetup($barcode, $get)
{
	if (isset($get['checksum'])) {
		$barcode->setChecksum($get['checksum'] === '1' ? true : false);
	}
}

$classFile = 'BCGcode39extended.barcode.php';
$className = 'BCGcode39extended';
$baseClassFile = 'BCGBarcode1D.php';
$codeVersion = '5.2.0';

?>
