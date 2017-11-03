<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
$dist = dirname(__DIR__) . '/dist';

if (!is_dir($dist)) {
	mkdir($dist, 493);
}

if (file_exists($dist . '/random_compat.phar')) {
	unlink($dist . '/random_compat.phar');
}

$phar = new Phar($dist . '/random_compat.phar', FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, 'random_compat.phar');
rename(dirname(__DIR__) . '/lib/random.php', dirname(__DIR__) . '/lib/index.php');
$phar->buildFromDirectory(dirname(__DIR__) . '/lib');
rename(dirname(__DIR__) . '/lib/index.php', dirname(__DIR__) . '/lib/random.php');

if (1 < $argc) {
	if (!@is_readable($argv[1])) {
		echo 'Could not read the private key file:';
		echo $argv[1];
		echo "\n";
		exit(255);
	}

	$pkeyFile = file_get_contents($argv[1]);
	$private = openssl_get_privatekey($pkeyFile);

	if ($private !== false) {
		$pkey = '';
		openssl_pkey_export($private, $pkey);
		$phar->setSignatureAlgorithm(Phar::OPENSSL, $pkey);

		if (!@is_readable($dist . '/random_compat.phar.pubkey')) {
			$details = openssl_pkey_get_details($private);
			file_put_contents($dist . '/random_compat.phar.pubkey', $details['key']);
		}
	}
	else {
		echo 'An error occurred reading the private key from OpenSSL.';
		echo "\n";
		exit(255);
	}
}

?>
