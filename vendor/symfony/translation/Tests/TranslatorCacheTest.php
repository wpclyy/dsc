<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests;

class TranslatorCacheTest extends \PHPUnit\Framework\TestCase
{
	protected $tmpDir;

	protected function setUp()
	{
		$this->tmpDir = sys_get_temp_dir() . '/sf2_translation';
		$this->deleteTmpDir();
	}

	protected function tearDown()
	{
		$this->deleteTmpDir();
	}

	protected function deleteTmpDir()
	{
		if (!file_exists($dir = $this->tmpDir)) {
			return NULL;
		}

		$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->tmpDir), \RecursiveIteratorIterator::CHILD_FIRST);

		foreach ($iterator as $path) {
			if (preg_match('#[/\\\\]\\.\\.?$#', $path->__toString())) {
				continue;
			}

			if ($path->isDir()) {
				rmdir($path->__toString());
			}
			else {
				unlink($path->__toString());
			}
		}

		rmdir($this->tmpDir);
	}

	public function testThatACacheIsUsed($debug)
	{
		$locale = 'any_locale';
		$format = 'some_format';
		$msgid = 'test';
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, $debug);
		$translator->addLoader($format, new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource($format, array($msgid => 'OK'), $locale);
		$translator->trans($msgid);
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, $debug);
		$translator->addLoader($format, $this->createFailingLoader());
		$translator->addResource($format, array($msgid => 'OK'), $locale);
		$this->assertEquals('OK', $translator->trans($msgid), '-> caching does not work in ' . ($debug ? 'debug' : 'production'));
	}

	public function testCatalogueIsReloadedWhenResourcesAreNoLongerFresh()
	{
		$locale = 'any_locale';
		$format = 'some_format';
		$msgid = 'test';
		$catalogue = new \Symfony\Component\Translation\MessageCatalogue($locale, array());
		$catalogue->addResource(new StaleResource());
		$loader = $this->getMockBuilder('Symfony\\Component\\Translation\\Loader\\LoaderInterface')->getMock();
		$loader->expects($this->exactly(2))->method('load')->will($this->returnValue($catalogue));
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, true);
		$translator->addLoader($format, $loader);
		$translator->addResource($format, null, $locale);
		$translator->trans($msgid);
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, true);
		$translator->addLoader($format, $loader);
		$translator->addResource($format, null, $locale);
		$translator->trans($msgid);
	}

	public function testDifferentTranslatorsForSameLocaleDoNotOverwriteEachOthersCache($debug)
	{
		$locale = 'any_locale';
		$format = 'some_format';
		$msgid = 'test';
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, $debug);
		$translator->addLoader($format, new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource($format, array($msgid => 'OK'), $locale);
		$translator->trans($msgid);
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, $debug);
		$translator->addLoader($format, new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource($format, array($msgid => 'FAIL'), $locale);
		$translator->trans($msgid);
		$translator = new \Symfony\Component\Translation\Translator($locale, null, $this->tmpDir, $debug);
		$translator->addLoader($format, $this->createFailingLoader());
		$translator->addResource($format, array($msgid => 'OK'), $locale);
		$this->assertEquals('OK', $translator->trans($msgid), '-> the cache was overwritten by another translator instance in ' . ($debug ? 'debug' : 'production'));
	}

	public function testGeneratedCacheFilesAreOnlyBelongRequestedLocales()
	{
		$translator = new \Symfony\Component\Translation\Translator('a', null, $this->tmpDir);
		$translator->setFallbackLocales(array('b'));
		$translator->trans('bar');
		$cachedFiles = glob($this->tmpDir . '/*.php');
		$this->assertCount(1, $cachedFiles);
	}

	public function testDifferentCacheFilesAreUsedForDifferentSetsOfFallbackLocales()
	{
		$translator = new \Symfony\Component\Translation\Translator('a', null, $this->tmpDir);
		$translator->setFallbackLocales(array('b'));
		$translator->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource('array', array('foo' => 'foo (a)'), 'a');
		$translator->addResource('array', array('bar' => 'bar (b)'), 'b');
		$this->assertEquals('bar (b)', $translator->trans('bar'));
		$translator->setFallbackLocales(array());
		$this->assertEquals('bar', $translator->trans('bar'));
		$translator = new \Symfony\Component\Translation\Translator('a', null, $this->tmpDir);
		$translator->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource('array', array('foo' => 'foo (a)'), 'a');
		$translator->addResource('array', array('bar' => 'bar (b)'), 'b');
		$this->assertEquals('bar', $translator->trans('bar'));
	}

	public function testPrimaryAndFallbackCataloguesContainTheSameMessagesRegardlessOfCaching()
	{
		$translator = new \Symfony\Component\Translation\Translator('a', null, $this->tmpDir);
		$translator->setFallbackLocales(array('b'));
		$translator->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource('array', array('foo' => 'foo (a)'), 'a');
		$translator->addResource('array', array('foo' => 'foo (b)'), 'b');
		$translator->addResource('array', array('bar' => 'bar (b)'), 'b');
		$catalogue = $translator->getCatalogue('a');
		$this->assertFalse($catalogue->defines('bar'));
		$fallback = $catalogue->getFallbackCatalogue();
		$this->assertTrue($fallback->defines('foo'));
		$translator = new \Symfony\Component\Translation\Translator('a', null, $this->tmpDir);
		$translator->setFallbackLocales(array('b'));
		$translator->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
		$translator->addResource('array', array('foo' => 'foo (a)'), 'a');
		$translator->addResource('array', array('foo' => 'foo (b)'), 'b');
		$translator->addResource('array', array('bar' => 'bar (b)'), 'b');
		$catalogue = $translator->getCatalogue('a');
		$this->assertFalse($catalogue->defines('bar'));
		$fallback = $catalogue->getFallbackCatalogue();
		$this->assertTrue($fallback->defines('foo'));
	}

	public function testRefreshCacheWhenResourcesAreNoLongerFresh()
	{
		$resource = $this->getMockBuilder('Symfony\\Component\\Config\\Resource\\SelfCheckingResourceInterface')->getMock();
		$loader = $this->getMockBuilder('Symfony\\Component\\Translation\\Loader\\LoaderInterface')->getMock();
		$resource->method('isFresh')->will($this->returnValue(false));
		$loader->expects($this->exactly(2))->method('load')->will($this->returnValue($this->getCatalogue('fr', array(), array($resource))));
		$translator = new \Symfony\Component\Translation\Translator('fr', null, $this->tmpDir, true);
		$translator->addLoader('loader', $loader);
		$translator->addResource('loader', 'foo', 'fr');
		$translator->trans('foo');
		$translator = new \Symfony\Component\Translation\Translator('fr', null, $this->tmpDir, true);
		$translator->addLoader('loader', $loader);
		$translator->addResource('loader', 'foo', 'fr');
		$translator->trans('foo');
	}

	protected function getCatalogue($locale, $messages, $resources = array())
	{
		$catalogue = new \Symfony\Component\Translation\MessageCatalogue($locale);

		foreach ($messages as $key => $translation) {
			$catalogue->set($key, $translation);
		}

		foreach ($resources as $resource) {
			$catalogue->addResource($resource);
		}

		return $catalogue;
	}

	public function runForDebugAndProduction()
	{
		return array(
	array(true),
	array(false)
	);
	}

	private function createFailingLoader()
	{
		$loader = $this->getMockBuilder('Symfony\\Component\\Translation\\Loader\\LoaderInterface')->getMock();
		$loader->expects($this->never())->method('load');
		return $loader;
	}
}
class StaleResource implements \Symfony\Component\Config\Resource\SelfCheckingResourceInterface
{
	public function isFresh($timestamp)
	{
		return false;
	}

	public function getResource()
	{
	}

	public function __toString()
	{
		return '';
	}
}

?>
