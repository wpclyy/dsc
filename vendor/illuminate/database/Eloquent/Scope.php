<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent;

interface Scope
{
	public function apply(Builder $builder, Model $model);
}


?>
