<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

abstract class Grammar
{
	/**
     * The grammar table prefix.
     *
     * @var string
     */
	protected $tablePrefix = '';

	public function wrapArray(array $values)
	{
		return array_map(array($this, 'wrap'), $values);
	}

	public function wrapTable($table)
	{
		if (!$this->isExpression($table)) {
			return $this->wrap($this->tablePrefix . $table, true);
		}

		return $this->getValue($table);
	}

	public function wrap($value, $prefixAlias = false)
	{
		if ($this->isExpression($value)) {
			return $this->getValue($value);
		}

		if (strpos(strtolower($value), ' as ') !== false) {
			return $this->wrapAliasedValue($value, $prefixAlias);
		}

		return $this->wrapSegments(explode('.', $value));
	}

	protected function wrapAliasedValue($value, $prefixAlias = false)
	{
		$segments = preg_split('/\\s+as\\s+/i', $value);

		if ($prefixAlias) {
			$segments[1] = $this->tablePrefix . $segments[1];
		}

		return $this->wrap($segments[0]) . ' as ' . $this->wrapValue($segments[1]);
	}

	protected function wrapSegments($segments)
	{
		return collect($segments)->map(function($segment, $key) use($segments) {
			return ($key == 0) && (1 < count($segments)) ? $this->wrapTable($segment) : $this->wrapValue($segment);
		})->implode('.');
	}

	protected function wrapValue($value)
	{
		if ($value !== '*') {
			return '"' . str_replace('"', '""', $value) . '"';
		}

		return $value;
	}

	public function columnize(array $columns)
	{
		return implode(', ', array_map(array($this, 'wrap'), $columns));
	}

	public function parameterize(array $values)
	{
		return implode(', ', array_map(array($this, 'parameter'), $values));
	}

	public function parameter($value)
	{
		return $this->isExpression($value) ? $this->getValue($value) : '?';
	}

	public function isExpression($value)
	{
		return $value instanceof Query\Expression;
	}

	public function getValue($expression)
	{
		return $expression->getValue();
	}

	public function getDateFormat()
	{
		return 'Y-m-d H:i:s';
	}

	public function getTablePrefix()
	{
		return $this->tablePrefix;
	}

	public function setTablePrefix($prefix)
	{
		$this->tablePrefix = $prefix;
		return $this;
	}
}


?>
