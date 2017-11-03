<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

interface MetadataAwareInterface
{
	public function getMetadata($key = '', $domain = 'messages');

	public function setMetadata($key, $value, $domain = 'messages');

	public function deleteMetadata($key = '', $domain = 'messages');
}


?>
