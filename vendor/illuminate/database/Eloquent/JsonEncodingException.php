<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent;

class JsonEncodingException extends \RuntimeException
{
	static public function forModel($model, $message)
	{
		return new static('Error encoding model [' . get_class($model) . '] with ID [' . $model->getKey() . '] to JSON: ' . $message);
	}

	static public function forAttribute($model, $key, $message)
	{
		$class = get_class($model);
		return new static('Unable to encode attribute [' . $key . '] for model [' . $class . '] to JSON: ' . $message . '.');
	}
}

?>
