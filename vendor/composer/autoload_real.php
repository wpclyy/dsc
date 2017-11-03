<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
class ComposerAutoloaderInit22a5f56f77b5522cc3ccfc627c4a78cd
{
	static private $loader;

	static public function loadClassLoader($class)
	{
		if ('Composer\\Autoload\\ClassLoader' === $class) {
			require __DIR__ . '/ClassLoader.php';
		}
	}

	static public function getLoader()
	{
		if (NULL !== self::$loader) {
			return self::$loader;
		}

		spl_autoload_register(array('ComposerAutoloaderInit22a5f56f77b5522cc3ccfc627c4a78cd', 'loadClassLoader'), true, true);
		self::$loader = $loader = new \Composer\Autoload\ClassLoader();
		spl_autoload_unregister(array('ComposerAutoloaderInit22a5f56f77b5522cc3ccfc627c4a78cd', 'loadClassLoader'));
		//$useStaticLoader = (50600 <= PHP_VERSION_ID) && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
		$useStaticLoader = (50600 <= PHP_VERSION_ID) && !defined('HHVM_VERSION') && (!true || !true);

		if ($useStaticLoader) {
			require_once __DIR__ . '/autoload_static.php';
			call_user_func(\Composer\Autoload\ComposerStaticInit22a5f56f77b5522cc3ccfc627c4a78cd::getInitializer($loader));
		}
		else {
			$map = require __DIR__ . '/autoload_namespaces.php';

			foreach ($map as $namespace => $path) {
				$loader->set($namespace, $path);
			}

			$map = require __DIR__ . '/autoload_psr4.php';

			foreach ($map as $namespace => $path) {
				$loader->setPsr4($namespace, $path);
			}

			$classMap = require __DIR__ . '/autoload_classmap.php';

			if ($classMap) {
				$loader->addClassMap($classMap);
			}
		}

		$loader->register(true);

		if ($useStaticLoader) {
			$includeFiles = \Composer\Autoload\ComposerStaticInit22a5f56f77b5522cc3ccfc627c4a78cd::$files;
		}
		else {
			$includeFiles = require __DIR__ . '/autoload_files.php';
		}

		foreach ($includeFiles as $fileIdentifier => $file) {
			composerRequire22a5f56f77b5522cc3ccfc627c4a78cd($fileIdentifier, $file);
		}

		return $loader;
	}
}

function composerRequire22a5f56f77b5522cc3ccfc627c4a78cd($fileIdentifier, $file)
{
	if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
		require $file;
		$GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
	}
}


?>
