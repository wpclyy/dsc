<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Doctrine\Tests\Common\Inflector;

class InflectorTest extends \Doctrine\Tests\DoctrineTestCase
{
	public function dataSampleWords()
	{
		\Doctrine\Common\Inflector\Inflector::reset();
		return array(
	array('', ''),
	array('Alias', 'Aliases'),
	array('alumnus', 'alumni'),
	array('analysis', 'analyses'),
	array('aquarium', 'aquaria'),
	array('arch', 'arches'),
	array('atlas', 'atlases'),
	array('axe', 'axes'),
	array('baby', 'babies'),
	array('bacillus', 'bacilli'),
	array('bacterium', 'bacteria'),
	array('bureau', 'bureaus'),
	array('bus', 'buses'),
	array('Bus', 'Buses'),
	array('cactus', 'cacti'),
	array('cafe', 'cafes'),
	array('calf', 'calves'),
	array('categoria', 'categorias'),
	array('chateau', 'chateaux'),
	array('cherry', 'cherries'),
	array('child', 'children'),
	array('church', 'churches'),
	array('circus', 'circuses'),
	array('city', 'cities'),
	array('cod', 'cod'),
	array('cookie', 'cookies'),
	array('copy', 'copies'),
	array('crisis', 'crises'),
	array('criterion', 'criteria'),
	array('curriculum', 'curricula'),
	array('curve', 'curves'),
	array('deer', 'deer'),
	array('demo', 'demos'),
	array('dictionary', 'dictionaries'),
	array('domino', 'dominoes'),
	array('dwarf', 'dwarves'),
	array('echo', 'echoes'),
	array('elf', 'elves'),
	array('emphasis', 'emphases'),
	array('family', 'families'),
	array('fax', 'faxes'),
	array('fish', 'fish'),
	array('flush', 'flushes'),
	array('fly', 'flies'),
	array('focus', 'foci'),
	array('foe', 'foes'),
	array('food_menu', 'food_menus'),
	array('FoodMenu', 'FoodMenus'),
	array('foot', 'feet'),
	array('fungus', 'fungi'),
	array('glove', 'gloves'),
	array('half', 'halves'),
	array('hero', 'heroes'),
	array('hippopotamus', 'hippopotami'),
	array('hoax', 'hoaxes'),
	array('house', 'houses'),
	array('human', 'humans'),
	array('identity', 'identities'),
	array('index', 'indices'),
	array('iris', 'irises'),
	array('kiss', 'kisses'),
	array('knife', 'knives'),
	array('leaf', 'leaves'),
	array('life', 'lives'),
	array('loaf', 'loaves'),
	array('man', 'men'),
	array('matrix', 'matrices'),
	array('matrix_row', 'matrix_rows'),
	array('medium', 'media'),
	array('memorandum', 'memoranda'),
	array('menu', 'menus'),
	array('Menu', 'Menus'),
	array('mess', 'messes'),
	array('moose', 'moose'),
	array('motto', 'mottoes'),
	array('mouse', 'mice'),
	array('neurosis', 'neuroses'),
	array('news', 'news'),
	array('NodeMedia', 'NodeMedia'),
	array('nucleus', 'nuclei'),
	array('oasis', 'oases'),
	array('octopus', 'octopuses'),
	array('pass', 'passes'),
	array('person', 'people'),
	array('plateau', 'plateaux'),
	array('potato', 'potatoes'),
	array('powerhouse', 'powerhouses'),
	array('quiz', 'quizzes'),
	array('radius', 'radii'),
	array('reflex', 'reflexes'),
	array('roof', 'roofs'),
	array('runner-up', 'runners-up'),
	array('scarf', 'scarves'),
	array('scratch', 'scratches'),
	array('series', 'series'),
	array('sheep', 'sheep'),
	array('shelf', 'shelves'),
	array('shoe', 'shoes'),
	array('son-in-law', 'sons-in-law'),
	array('species', 'species'),
	array('splash', 'splashes'),
	array('spy', 'spies'),
	array('stimulus', 'stimuli'),
	array('stitch', 'stitches'),
	array('story', 'stories'),
	array('syllabus', 'syllabi'),
	array('tax', 'taxes'),
	array('terminus', 'termini'),
	array('thesis', 'theses'),
	array('thief', 'thieves'),
	array('tomato', 'tomatoes'),
	array('tooth', 'teeth'),
	array('tornado', 'tornadoes'),
	array('try', 'tries'),
	array('vertex', 'vertices'),
	array('virus', 'viri'),
	array('volcano', 'volcanoes'),
	array('wash', 'washes'),
	array('watch', 'watches'),
	array('wave', 'waves'),
	array('wharf', 'wharves'),
	array('wife', 'wives'),
	array('woman', 'women')
	);
	}

	public function testInflectingSingulars($singular, $plural)
	{
		$this->assertEquals($singular, \Doctrine\Common\Inflector\Inflector::singularize($plural), '\'' . $plural . '\' should be singularized to \'' . $singular . '\'');
	}

	public function testInflectingPlurals($singular, $plural)
	{
		$this->assertEquals($plural, \Doctrine\Common\Inflector\Inflector::pluralize($singular), '\'' . $singular . '\' should be pluralized to \'' . $plural . '\'');
	}

	public function testCustomPluralRule()
	{
		\Doctrine\Common\Inflector\Inflector::reset();
		\Doctrine\Common\Inflector\Inflector::rules('plural', array('/^(custom)$/i' => '\\1izables'));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('custom'), 'customizables');
		\Doctrine\Common\Inflector\Inflector::rules('plural', array(
	'uninflected' => array('uninflectable')
	));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('uninflectable'), 'uninflectable');
		\Doctrine\Common\Inflector\Inflector::rules('plural', array(
	'rules'       => array('/^(alert)$/i' => '\\1ables'),
	'uninflected' => array('noflect', 'abtuse'),
	'irregular'   => array('amaze' => 'amazable', 'phone' => 'phonezes')
	));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('noflect'), 'noflect');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('abtuse'), 'abtuse');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('alert'), 'alertables');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('amaze'), 'amazable');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('phone'), 'phonezes');
	}

	public function testCustomSingularRule()
	{
		\Doctrine\Common\Inflector\Inflector::reset();
		\Doctrine\Common\Inflector\Inflector::rules('singular', array('/(eple)r$/i' => '\\1', '/(jente)r$/i' => '\\1'));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('epler'), 'eple');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('jenter'), 'jente');
		\Doctrine\Common\Inflector\Inflector::rules('singular', array(
	'rules'       => array('/^(bil)er$/i' => '\\1', '/^(inflec|contribu)tors$/i' => '\\1ta'),
	'uninflected' => array('singulars'),
	'irregular'   => array('spins' => 'spinor')
	));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('inflectors'), 'inflecta');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('contributors'), 'contributa');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('spins'), 'spinor');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('singulars'), 'singulars');
	}

	public function testRulesClearsCaches()
	{
		\Doctrine\Common\Inflector\Inflector::reset();
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('Bananas'), 'Banana');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('Banana'), 'Bananas');
		\Doctrine\Common\Inflector\Inflector::rules('singular', array(
	'rules' => array('/(.*)nas$/i' => '\\1zzz')
	));
		$this->assertEquals('Banazzz', \Doctrine\Common\Inflector\Inflector::singularize('Bananas'), 'Was inflected with old rules.');
		\Doctrine\Common\Inflector\Inflector::rules('plural', array(
	'rules'     => array('/(.*)na$/i' => '\\1zzz'),
	'irregular' => array('corpus' => 'corpora')
	));
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('Banana'), 'Banazzz', 'Was inflected with old rules.');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('corpus'), 'corpora', 'Was inflected with old irregular form.');
	}

	public function testCustomRuleWithReset()
	{
		\Doctrine\Common\Inflector\Inflector::reset();
		$uninflected = array('atlas', 'lapis', 'onibus', 'pires', 'virus', '.*x');
		$pluralIrregular = array('as' => 'ases');
		\Doctrine\Common\Inflector\Inflector::rules('singular', array(
	'rules'       => array('/^(.*)(a|e|o|u)is$/i' => '\\1\\2l'),
	'uninflected' => $uninflected
	), true);
		\Doctrine\Common\Inflector\Inflector::rules('plural', array(
	'rules'       => array('/^(.*)(a|e|o|u)l$/i' => '\\1\\2is'),
	'uninflected' => $uninflected,
	'irregular'   => $pluralIrregular
	), true);
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('Alcool'), 'Alcoois');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::pluralize('Atlas'), 'Atlas');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('Alcoois'), 'Alcool');
		$this->assertEquals(\Doctrine\Common\Inflector\Inflector::singularize('Atlas'), 'Atlas');
	}

	public function testUcwords()
	{
		$this->assertSame('Top-O-The-Morning To All_of_you!', \Doctrine\Common\Inflector\Inflector::ucwords('top-o-the-morning to all_of_you!'));
	}

	public function testUcwordsWithCustomDelimeters()
	{
		$this->assertSame('Top-O-The-Morning To All_Of_You!', \Doctrine\Common\Inflector\Inflector::ucwords('top-o-the-morning to all_of_you!', '-_ '));
	}
}

?>
