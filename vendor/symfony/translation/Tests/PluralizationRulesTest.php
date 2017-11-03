<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Symfony\Component\Translation\Tests;

class PluralizationRulesTest extends \PHPUnit\Framework\TestCase
{
	public function testFailedLangcodes($nplural, $langCodes)
	{
		$matrix = $this->generateTestData($langCodes);
		$this->validateMatrix($nplural, $matrix, false);
	}

	public function testLangcodes($nplural, $langCodes)
	{
		$matrix = $this->generateTestData($langCodes);
		$this->validateMatrix($nplural, $matrix);
	}

	public function successLangcodes()
	{
		return array(
	array(
		'1',
		array('ay', 'bo', 'cgg', 'dz', 'id', 'ja', 'jbo', 'ka', 'kk', 'km', 'ko', 'ky')
		),
	array(
		'2',
		array('nl', 'fr', 'en', 'de', 'de_GE', 'hy', 'hy_AM')
		),
	array(
		'3',
		array('be', 'bs', 'cs', 'hr')
		),
	array(
		'4',
		array('cy', 'mt', 'sl')
		),
	array(
		'6',
		array('ar')
		)
	);
	}

	public function failingLangcodes()
	{
		return array(
	array(
		'1',
		array('fa')
		),
	array(
		'2',
		array('jbo')
		),
	array(
		'3',
		array('cbs')
		),
	array(
		'4',
		array('gd', 'kw')
		),
	array(
		'5',
		array('ga')
		)
	);
	}

	protected function validateMatrix($nplural, $matrix, $expectSuccess = true)
	{
		foreach ($matrix as $langCode => $data) {
			$indexes = array_flip($data);

			if ($expectSuccess) {
				$this->assertEquals($nplural, count($indexes), 'Langcode \'' . $langCode . '\' has \'' . $nplural . '\' plural forms.');
			}
			else {
				$this->assertNotEquals((int) $nplural, count($indexes), 'Langcode \'' . $langCode . '\' has \'' . $nplural . '\' plural forms.');
			}
		}
	}

	protected function generateTestData($langCodes)
	{
		$matrix = array();

		foreach ($langCodes as $langCode) {
			for ($count = 0; $count < 200; ++$count) {
				$plural = \Symfony\Component\Translation\PluralizationRules::get($count, $langCode);
				$matrix[$langCode][$count] = $plural;
			}
		}

		return $matrix;
	}
}

?>
