<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Loader;

class CsvFileLoader extends FileLoader
{
	private $delimiter = ';';
	private $enclosure = '"';
	private $escape = '\\';

	protected function loadResource($resource)
	{
		$messages = array();

		try {
			$file = new \SplFileObject($resource, 'rb');
		}
		catch (\RuntimeException $e) {
			throw new \Symfony\Component\Translation\Exception\NotFoundResourceException(sprintf('Error opening file "%s".', $resource), 0, $e);
		}

		$file->setFlags(\SplFileObject::READ_CSV | \SplFileObject::SKIP_EMPTY);
		$file->setCsvControl($this->delimiter, $this->enclosure, $this->escape);

		foreach ($file as $data) {
			if (('#' !== substr($data[0], 0, 1)) && isset($data[1]) && (2 === count($data))) {
				$messages[$data[0]] = $data[1];
			}
		}

		return $messages;
	}

	public function setCsvControl($delimiter = ';', $enclosure = '"', $escape = '\\')
	{
		$this->delimiter = $delimiter;
		$this->enclosure = $enclosure;
		$this->escape = $escape;
	}
}

?>
