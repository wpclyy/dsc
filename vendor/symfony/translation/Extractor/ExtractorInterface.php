<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Extractor;

interface ExtractorInterface
{
	public function extract($resource, \Symfony\Component\Translation\MessageCatalogue $catalogue);

	public function setPrefix($prefix);
}


?>
