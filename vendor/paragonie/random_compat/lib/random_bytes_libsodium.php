<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
if (!is_callable('random_bytes')) {
	function random_bytes($bytes)
	{
		try {
			$bytes = RandomCompat_intval($bytes);
		}
		catch (TypeError $ex) {
			throw new TypeError('random_bytes(): $bytes must be an integer');
		}

		if ($bytes < 1) {
			throw new Error('Length must be greater than 0');
		}

		if (2147483647 < $bytes) {
			$buf = '';

			for ($i = 0; $i < $bytes; $i += 1073741824) {
				$n = (1073741824 < ($bytes - $i) ? 1073741824 : $bytes - $i);
				$buf .= \Sodium\randombytes_buf($n);
			}
		}
		else {
			$buf = \Sodium\randombytes_buf($bytes);
		}

		if ($buf !== false) {
			if (RandomCompat_strlen($buf) === $bytes) {
				return $buf;
			}
		}

		throw new Exception('Could not gather sufficient random data');
	}
}

?>
