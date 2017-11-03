<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

class LoggingTranslator implements TranslatorInterface, TranslatorBagInterface
{
	/**
     * @var TranslatorInterface|TranslatorBagInterface
     */
	private $translator;
	/**
     * @var LoggerInterface
     */
	private $logger;

	public function __construct(TranslatorInterface $translator, \Psr\Log\LoggerInterface $logger)
	{
		if (!$translator instanceof TranslatorBagInterface) {
			throw new Exception\InvalidArgumentException(sprintf('The Translator "%s" must implement TranslatorInterface and TranslatorBagInterface.', get_class($translator)));
		}

		$this->translator = $translator;
		$this->logger = $logger;
	}

	public function trans($id, array $parameters = array(), $domain = NULL, $locale = NULL)
	{
		$trans = $this->translator->trans($id, $parameters, $domain, $locale);
		$this->log($id, $domain, $locale);
		return $trans;
	}

	public function transChoice($id, $number, array $parameters = array(), $domain = NULL, $locale = NULL)
	{
		$trans = $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
		$this->log($id, $domain, $locale);
		return $trans;
	}

	public function setLocale($locale)
	{
		$this->translator->setLocale($locale);
	}

	public function getLocale()
	{
		return $this->translator->getLocale();
	}

	public function getCatalogue($locale = NULL)
	{
		return $this->translator->getCatalogue($locale);
	}

	public function getFallbackLocales()
	{
		if ($this->translator instanceof Translator || method_exists($this->translator, 'getFallbackLocales')) {
			return $this->translator->getFallbackLocales();
		}

		return array();
	}

	public function __call($method, $args)
	{
		return call_user_func_array(array($this->translator, $method), $args);
	}

	private function log($id, $domain, $locale)
	{
		if (null === $domain) {
			$domain = 'messages';
		}

		$id = (string) $id;
		$catalogue = $this->translator->getCatalogue($locale);

		if ($catalogue->defines($id, $domain)) {
			return NULL;
		}

		if ($catalogue->has($id, $domain)) {
			$this->logger->debug('Translation use fallback catalogue.', array('id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()));
		}
		else {
			$this->logger->warning('Translation not found.', array('id' => $id, 'domain' => $domain, 'locale' => $catalogue->getLocale()));
		}
	}
}

?>
