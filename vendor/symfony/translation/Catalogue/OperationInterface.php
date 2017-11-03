<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Catalogue;

interface OperationInterface
{
	public function getDomains();

	public function getMessages($domain);

	public function getNewMessages($domain);

	public function getObsoleteMessages($domain);

	public function getResult();
}


?>
