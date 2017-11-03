<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

interface MessageCatalogueInterface
{
	public function getLocale();

	public function getDomains();

	public function all($domain = NULL);

	public function set($id, $translation, $domain = 'messages');

	public function has($id, $domain = 'messages');

	public function defines($id, $domain = 'messages');

	public function get($id, $domain = 'messages');

	public function replace($messages, $domain = 'messages');

	public function add($messages, $domain = 'messages');

	public function addCatalogue(MessageCatalogueInterface $catalogue);

	public function addFallbackCatalogue(MessageCatalogueInterface $catalogue);

	public function getFallbackCatalogue();

	public function getResources();

	public function addResource(\Symfony\Component\Config\Resource\ResourceInterface $resource);
}


?>
