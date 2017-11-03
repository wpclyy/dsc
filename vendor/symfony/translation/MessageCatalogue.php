<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

class MessageCatalogue implements MessageCatalogueInterface, MetadataAwareInterface
{
	private $messages = array();
	private $metadata = array();
	private $resources = array();
	private $locale;
	private $fallbackCatalogue;
	private $parent;

	public function __construct($locale, array $messages = array())
	{
		$this->locale = $locale;
		$this->messages = $messages;
	}

	public function getLocale()
	{
		return $this->locale;
	}

	public function getDomains()
	{
		return array_keys($this->messages);
	}

	public function all($domain = NULL)
	{
		if (null === $domain) {
			return $this->messages;
		}

		return isset($this->messages[$domain]) ? $this->messages[$domain] : array();
	}

	public function set($id, $translation, $domain = 'messages')
	{
		$this->add(array($id => $translation), $domain);
	}

	public function has($id, $domain = 'messages')
	{
		if (isset($this->messages[$domain][$id])) {
			return true;
		}

		if (null !== $this->fallbackCatalogue) {
			return $this->fallbackCatalogue->has($id, $domain);
		}

		return false;
	}

	public function defines($id, $domain = 'messages')
	{
		return isset($this->messages[$domain][$id]);
	}

	public function get($id, $domain = 'messages')
	{
		if (isset($this->messages[$domain][$id])) {
			return $this->messages[$domain][$id];
		}

		if (null !== $this->fallbackCatalogue) {
			return $this->fallbackCatalogue->get($id, $domain);
		}

		return $id;
	}

	public function replace($messages, $domain = 'messages')
	{
		$this->messages[$domain] = array();
		$this->add($messages, $domain);
	}

	public function add($messages, $domain = 'messages')
	{
		if (!isset($this->messages[$domain])) {
			$this->messages[$domain] = $messages;
		}
		else {
			$this->messages[$domain] = array_replace($this->messages[$domain], $messages);
		}
	}

	public function addCatalogue(MessageCatalogueInterface $catalogue)
	{
		if ($catalogue->getLocale() !== $this->locale) {
			throw new Exception\LogicException(sprintf('Cannot add a catalogue for locale "%s" as the current locale for this catalogue is "%s"', $catalogue->getLocale(), $this->locale));
		}

		foreach ($catalogue->all() as $domain => $messages) {
			$this->add($messages, $domain);
		}

		foreach ($catalogue->getResources() as $resource) {
			$this->addResource($resource);
		}

		if ($catalogue instanceof MetadataAwareInterface) {
			$metadata = $catalogue->getMetadata('', '');
			$this->addMetadata($metadata);
		}
	}

	public function addFallbackCatalogue(MessageCatalogueInterface $catalogue)
	{
		$c = $catalogue;

		while ($c = $c->getFallbackCatalogue()) {
			if ($c->getLocale() === $this->getLocale()) {
				throw new Exception\LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
			}
		}

		$c = $this;

		do {
			if ($c->getLocale() === $catalogue->getLocale()) {
				throw new Exception\LogicException(sprintf('Circular reference detected when adding a fallback catalogue for locale "%s".', $catalogue->getLocale()));
			}

			foreach ($catalogue->getResources() as $resource) {
				$c->addResource($resource);
			}
		} while ($c = $c->parent);

		$catalogue->parent = $this;
		$this->fallbackCatalogue = $catalogue;

		foreach ($catalogue->getResources() as $resource) {
			$this->addResource($resource);
		}
	}

	public function getFallbackCatalogue()
	{
		return $this->fallbackCatalogue;
	}

	public function getResources()
	{
		return array_values($this->resources);
	}

	public function addResource(\Symfony\Component\Config\Resource\ResourceInterface $resource)
	{
		$this->resources[$resource->__toString()] = $resource;
	}

	public function getMetadata($key = '', $domain = 'messages')
	{
		if ('' == $domain) {
			return $this->metadata;
		}

		if (isset($this->metadata[$domain])) {
			if ('' == $key) {
				return $this->metadata[$domain];
			}

			if (isset($this->metadata[$domain][$key])) {
				return $this->metadata[$domain][$key];
			}
		}
	}

	public function setMetadata($key, $value, $domain = 'messages')
	{
		$this->metadata[$domain][$key] = $value;
	}

	public function deleteMetadata($key = '', $domain = 'messages')
	{
		if ('' == $domain) {
			$this->metadata = array();
		}
		else if ('' == $key) {
			unset($this->metadata[$domain]);
		}
		else {
			unset($this->metadata[$domain][$key]);
		}
	}

	private function addMetadata(array $values)
	{
		foreach ($values as $domain => $keys) {
			foreach ($keys as $key => $value) {
				$this->setMetadata($key, $value, $domain);
			}
		}
	}
}

?>
