<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent\Relations;

class HasMany extends HasOneOrMany
{
	public function getResults()
	{
		return $this->query->get();
	}

	public function initRelation(array $models, $relation)
	{
		foreach ($models as $model) {
			$model->setRelation($relation, $this->related->newCollection());
		}

		return $models;
	}

	public function match(array $models, \Illuminate\Database\Eloquent\Collection $results, $relation)
	{
		return $this->matchMany($models, $results, $relation);
	}
}

?>
