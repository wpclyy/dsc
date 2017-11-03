<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation;

class DataCollectorTranslator implements TranslatorInterface, TranslatorBagInterface
{
	const MESSAGE_DEFINED = 0;
	const MESSAGE_MISSING = 1;
	const MESSAGE_EQUALS_FALLBACK = 2;

	/**
     * @var TranslatorInterface|TranslatorBagInterface
     */
	private $translator;
	/**
     * @var array
     */
	private $messages = array();

	public function __construct(TranslatorInterface $translator)
	{
		if (!$translator instanceof TranslatorBagInterface) {
			throw new Exception\InvalidArgumentException(sprintf('The Translator "%s" must implement TranslatorInterface and TranslatorBagInterface.', get_class($translator)));
		}

		$this->translator = $translator;
	}

	public function trans($id, array $parameters = array(), $domain = NULL, $locale = NULL)
	{
		$trans = $this->translator->trans($id, $parameters, $domain, $locale);
		$this->collectMessage($locale, $domain, $id, $trans, $parameters);
		return $trans;
	}

	public function transChoice($id, $number, array $parameters = array(), $domain = NULL, $locale = NULL)
	{
		$trans = $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
		$this->collectMessage($locale, $domain, $id, $trans, $parameters, $number);
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

	public function getCollectedMessages()
	{
		return $this->messages;
	}

	private function collectMessage($locale, $domain, $id, $translation, $parameters = array(), $number = NULL)
	{
		if (null === $domain) {
			$domain = 'messages';
		}

		$id = (string) $id;
		$catalogue = $this->translator->getCatalogue($locale);
		$locale = $catalogue->getLocale();

		if ($catalogue->defines($id, $domain)) {
			$state = self::MESSAGE_DEFINED;
		}
		else if ($catalogue->has($id, $domain)) {
			$state = self::MESSAGE_EQUALS_FALLBACK;
			$fallbackCatalogue = $catalogue->getFallbackCatalogue();

			while ($fallbackCatalogue) {
				if ($fallbackCatalogue->defines($id, $domain)) {
					$locale = $fallbackCatalogue->getLocale();
					break;
				}

				$fallbackCatalogue = $fallbackCatalogue->getFallbackCatalogue();
			}
		}
		else {
			$state = self::MESSAGE_MISSING;
		}

		$this->messages[] = array('locale' => $locale, 'domain' => $domain, 'id' => $id, 'translation' => $translation, 'parameters' => $parameters, 'transChoiceNumber' => $number, 'state' => $state);
	}
}

?>
