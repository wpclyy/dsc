<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Dumper;

class QtFileDumper extends FileDumper
{
	public function formatCatalogue(\Symfony\Component\Translation\MessageCatalogue $messages, $domain, array $options = array())
	{
		$dom = new \DOMDocument('1.0', 'utf-8');
		$dom->formatOutput = true;
		$ts = $dom->appendChild($dom->createElement('TS'));
		$context = $ts->appendChild($dom->createElement('context'));
		$context->appendChild($dom->createElement('name', $domain));

		foreach ($messages->all($domain) as $source => $target) {
			$message = $context->appendChild($dom->createElement('message'));
			$message->appendChild($dom->createElement('source', $source));
			$message->appendChild($dom->createElement('translation', $target));
		}

		return $dom->saveXML();
	}

	protected function getExtension()
	{
		return 'ts';
	}
}

?>
