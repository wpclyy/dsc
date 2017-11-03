<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
if (!class_exists('Error', false)) {
	class Error extends Exception
	{	}
}

if (!class_exists('TypeError', false)) {
	if (is_subclass_of('Error', 'Exception')) {
		class TypeError extends Error
		{		}
	}
	else {
		class TypeError extends Exception
		{		}
	}
}

?>
