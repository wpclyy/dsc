<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Contracts\Database;

class ModelIdentifier
{
	/**
     * The class name of the model.
     *
     * @var string
     */
	public $class;
	/**
     * The unique identifier of the model.
     *
     * This may be either a single ID or an array of IDs.
     *
     * @var mixed
     */
	public $id;

	public function __construct($class, $id)
	{
		$this->id = $id;
		$this->class = $class;
	}
}


?>
