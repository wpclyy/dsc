<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
if (!is_callable('RandomCompat_intval')) {
	function RandomCompat_intval($number, $fail_open = false)
	{
		if (is_int($number) || is_float($number)) {
			$number += 0;
		}
		else if (is_numeric($number)) {
			$number += 0;
		}

		if (is_float($number) && (~PHP_INT_MAX < $number) && ($number < PHP_INT_MAX)) {
			$number = (int) $number;
		}

		if (is_int($number)) {
			return (int) $number;
		}
		else if (!$fail_open) {
			throw new TypeError('Expected an integer.');
		}

		return $number;
	}
}

?>
