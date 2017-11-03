<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Eloquent\Concerns;

trait HidesAttributes
{
	/**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
	protected $hidden = array();
	/**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
	protected $visible = array();

	public function getHidden()
	{
		return $this->hidden;
	}

	public function setHidden(array $hidden)
	{
		$this->hidden = $hidden;
		return $this;
	}

	public function addHidden($attributes = NULL)
	{
		$this->hidden = array_merge($this->hidden, is_array($attributes) ? $attributes : func_get_args());
	}

	public function getVisible()
	{
		return $this->visible;
	}

	public function setVisible(array $visible)
	{
		$this->visible = $visible;
		return $this;
	}

	public function addVisible($attributes = NULL)
	{
		$this->visible = array_merge($this->visible, is_array($attributes) ? $attributes : func_get_args());
	}

	public function makeVisible($attributes)
	{
		$this->hidden = array_diff($this->hidden, (array) $attributes);

		if (!empty($this->visible)) {
			$this->addVisible($attributes);
		}

		return $this;
	}

	public function makeHidden($attributes)
	{
		$attributes = (array) $attributes;
		$this->visible = array_diff($this->visible, $attributes);
		$this->hidden = array_unique(array_merge($this->hidden, $attributes));
		return $this;
	}
}


?>
