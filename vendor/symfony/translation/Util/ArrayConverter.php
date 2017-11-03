<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Util;

class ArrayConverter
{
	static public function expandToTree(array $messages)
	{
		$tree = array();

		foreach ($messages as $id => $value) {
			$referenceToElement = &self::getElementByPath($tree, explode('.', $id));
			$referenceToElement = $value;
			unset($referenceToElement);
		}

		return $tree;
	}

	static private function& getElementByPath(array &$tree, array $parts)
	{
		$elem = &$tree;
		$parentOfElem = null;

		foreach ($parts as $i => $part) {
			if (isset($elem[$part]) && is_string($elem[$part])) {
				$elem = &$elem[implode('.', array_slice($parts, $i))];
				break;
			}

			$parentOfElem = &$elem;
			$elem = &$elem[$part];
		}

		if (is_array($elem) && (0 < count($elem)) && $parentOfElem) {
			self::cancelExpand($parentOfElem, $part, $elem);
		}

		return $elem;
	}

	static private function cancelExpand(array &$tree, $prefix, array $node)
	{
		$prefix .= '.';

		foreach ($node as $id => $value) {
			if (is_string($value)) {
				$tree[$prefix . $id] = $value;
			}
			else {
				self::cancelExpand($tree, $prefix . $id, $value);
			}
		}
	}
}


?>
