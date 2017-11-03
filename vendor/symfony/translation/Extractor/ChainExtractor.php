<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Extractor;

class ChainExtractor implements ExtractorInterface
{
	/**
     * The extractors.
     *
     * @var ExtractorInterface[]
     */
	private $extractors = array();

	public function addExtractor($format, ExtractorInterface $extractor)
	{
		$this->extractors[$format] = $extractor;
	}

	public function setPrefix($prefix)
	{
		foreach ($this->extractors as $extractor) {
			$extractor->setPrefix($prefix);
		}
	}

	public function extract($directory, \Symfony\Component\Translation\MessageCatalogue $catalogue)
	{
		foreach ($this->extractors as $extractor) {
			$extractor->extract($directory, $catalogue);
		}
	}
}

?>
