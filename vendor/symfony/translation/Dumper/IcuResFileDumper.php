<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Dumper;

class IcuResFileDumper extends FileDumper
{
	/**
     * {@inheritdoc}
     */
	protected $relativePathTemplate = '%domain%/%locale%.%extension%';

	public function formatCatalogue(\Symfony\Component\Translation\MessageCatalogue $messages, $domain, array $options = array())
	{
		$data = $indexes = $resources = '';

		foreach ($messages->all($domain) as $source => $target) {
			$indexes .= pack('v', strlen($data) + 28);
			$data .= $source . "\x00";
		}

		$data .= $this->writePadding($data);
		$keyTop = $this->getPosition($data);

		foreach ($messages->all($domain) as $source => $target) {
			$resources .= pack('V', $this->getPosition($data));
			$data .= pack('V', strlen($target)) . mb_convert_encoding($target . "\x00", 'UTF-16LE', 'UTF-8') . $this->writePadding($data);
		}

		$resOffset = $this->getPosition($data);
		$data .= pack('v', count($messages->all($domain))) . $indexes . $this->writePadding($data) . $resources;
		$bundleTop = $this->getPosition($data);
		$root = pack('V7', $resOffset + (2 << 28), 6, $keyTop, $bundleTop, $bundleTop, count($messages->all($domain)), 0);
		$header = pack('vC2v4C12@32', 32, 218, 39, 20, 0, 0, 2, 82, 101, 115, 66, 1, 2, 0, 0, 1, 4, 0, 0);
		return $header . $root . $data;
	}

	private function writePadding($data)
	{
		$padding = strlen($data) % 4;

		if ($padding) {
			return str_repeat("\xaa", 4 - $padding);
		}
	}

	private function getPosition($data)
	{
		return (strlen($data) + 28) / 4;
	}

	protected function getExtension()
	{
		return 'res';
	}
}

?>
