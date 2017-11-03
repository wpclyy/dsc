<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Support;

class NamespacedItemResolver
{
	/**
     * A cache of the parsed items.
     *
     * @var array
     */
	protected $parsed = array();

	public function parseKey($key)
	{
		if (isset($this->parsed[$key])) {
			return $this->parsed[$key];
		}

		if (strpos($key, '::') === false) {
			$segments = explode('.', $key);
			$parsed = $this->parseBasicSegments($segments);
		}
		else {
			$parsed = $this->parseNamespacedSegments($key);
		}

		return $this->parsed[$key] = $parsed;
	}

	protected function parseBasicSegments(array $segments)
	{
		$group = $segments[0];

		if (count($segments) == 1) {
			return array(null, $group, null);
		}
		else {
			$item = implode('.', array_slice($segments, 1));
			return array(null, $group, $item);
		}
	}

	protected function parseNamespacedSegments($key)
	{
		list($namespace, $item) = explode('::', $key);
		$itemSegments = explode('.', $item);
		$groupAndItem = array_slice($this->parseBasicSegments($itemSegments), 1);
		return array_merge(array($namespace), $groupAndItem);
	}

	public function setParsedKey($key, $parsed)
	{
		$this->parsed[$key] = $parsed;
	}
}


?>
