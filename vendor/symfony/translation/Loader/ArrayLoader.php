<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Loader;

class ArrayLoader implements LoaderInterface
{
	public function load($resource, $locale, $domain = 'messages')
	{
		$this->flatten($resource);
		$catalogue = new \Symfony\Component\Translation\MessageCatalogue($locale);
		$catalogue->add($resource, $domain);
		return $catalogue;
	}

	private function flatten(array &$messages, array $subnode = NULL, $path = NULL)
	{
		if (null === $subnode) {
			$subnode = &$messages;
		}

		foreach ($subnode as $key => $value) {
			if (is_array($value)) {
				$nodePath = ($path ? $path . '.' . $key : $key);
				$this->flatten($messages, $value, $nodePath);

				if (null === $path) {
					unset($messages[$key]);
				}
			}
			else if (null !== $path) {
				$messages[$path . '.' . $key] = $value;
			}
		}
	}
}

?>
