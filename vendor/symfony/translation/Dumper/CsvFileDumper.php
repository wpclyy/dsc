<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Dumper;

class CsvFileDumper extends FileDumper
{
	private $delimiter = ';';
	private $enclosure = '"';

	public function formatCatalogue(\Symfony\Component\Translation\MessageCatalogue $messages, $domain, array $options = array())
	{
		$handle = fopen('php://memory', 'rb+');

		foreach ($messages->all($domain) as $source => $target) {
			fputcsv($handle, array($source, $target), $this->delimiter, $this->enclosure);
		}

		rewind($handle);
		$output = stream_get_contents($handle);
		fclose($handle);
		return $output;
	}

	public function setCsvControl($delimiter = ';', $enclosure = '"')
	{
		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
	}

	protected function getExtension()
	{
		return 'csv';
	}
}

?>
