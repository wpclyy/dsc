<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
if (!function_exists('mb_strlen')) {
	define('MB_CASE_UPPER', 0);
	define('MB_CASE_LOWER', 1);
	define('MB_CASE_TITLE', 2);
	function mb_convert_encoding($s, $to, $from = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_convert_encoding($s, $to, $from);
	}
	function mb_decode_mimeheader($s)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_decode_mimeheader($s);
	}
	function mb_encode_mimeheader($s, $charset = NULL, $transferEnc = NULL, $lf = NULL, $indent = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_encode_mimeheader($s, $charset, $transferEnc, $lf, $indent);
	}
	function mb_convert_case($s, $mode, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_convert_case($s, $mode, $enc);
	}
	function mb_internal_encoding($enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_internal_encoding($enc);
	}
	function mb_language($lang = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_language($lang);
	}
	function mb_list_encodings()
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_list_encodings();
	}
	function mb_encoding_aliases($encoding)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_encoding_aliases($encoding);
	}
	function mb_check_encoding($var = NULL, $encoding = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_check_encoding($var, $encoding);
	}
	function mb_detect_encoding($str, $encodingList = NULL, $strict = false)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_detect_encoding($str, $encodingList, $strict);
	}
	function mb_detect_order($encodingList = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_detect_order($encodingList);
	}
	function mb_parse_str($s, &$result = array())
	{
		parse_str($s, $result);
	}
	function mb_strlen($s, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strlen($s, $enc);
	}
	function mb_strpos($s, $needle, $offset = 0, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strpos($s, $needle, $offset, $enc);
	}
	function mb_strtolower($s, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strtolower($s, $enc);
	}
	function mb_strtoupper($s, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strtoupper($s, $enc);
	}
	function mb_substitute_character($char = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_substitute_character($char);
	}
	function mb_substr($s, $start, $length = 2147483647, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_substr($s, $start, $length, $enc);
	}
	function mb_stripos($s, $needle, $offset = 0, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_stripos($s, $needle, $offset, $enc);
	}
	function mb_stristr($s, $needle, $part = false, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_stristr($s, $needle, $part, $enc);
	}
	function mb_strrchr($s, $needle, $part = false, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strrchr($s, $needle, $part, $enc);
	}
	function mb_strrichr($s, $needle, $part = false, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strrichr($s, $needle, $part, $enc);
	}
	function mb_strripos($s, $needle, $offset = 0, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strripos($s, $needle, $offset, $enc);
	}
	function mb_strrpos($s, $needle, $offset = 0, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strrpos($s, $needle, $offset, $enc);
	}
	function mb_strstr($s, $needle, $part = false, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strstr($s, $needle, $part, $enc);
	}
	function mb_get_info($type = 'all')
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_get_info($type);
	}
	function mb_http_output($enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_http_output($enc);
	}
	function mb_strwidth($s, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_strwidth($s, $enc);
	}
	function mb_substr_count($haystack, $needle, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_substr_count($haystack, $needle, $enc);
	}
	function mb_output_handler($contents, $status)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_output_handler($contents, $status);
	}
	function mb_http_input($type = '')
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_http_input($type);
	}
	function mb_convert_variables($toEncoding, $fromEncoding, &$a = NULL, &$b = NULL, &$c = NULL, &$d = NULL, &$e = NULL, &$f = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_convert_variables($toEncoding, $fromEncoding, $a, $b, $c, $d, $e, $f);
	}
}

if (!function_exists('mb_chr')) {
	function mb_ord($s, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_ord($s, $enc);
	}
	function mb_chr($code, $enc = NULL)
	{
		return \Symfony\Polyfill\Mbstring\Mbstring::mb_chr($code, $enc);
	}
	function mb_scrub($s, $enc = NULL)
	{
		$enc = (NULL === $enc ? mb_internal_encoding() : $enc);
		return mb_convert_encoding($s, $enc, $enc);
	}
}

?>
