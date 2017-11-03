<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database;

class QueryException extends \PDOException
{
	/**
     * The SQL for the query.
     *
     * @var string
     */
	protected $sql;
	/**
     * The bindings for the query.
     *
     * @var array
     */
	protected $bindings;

	public function __construct($sql, array $bindings, $previous)
	{
		parent::__construct('', 0, $previous);
		$this->sql = $sql;
		$this->bindings = $bindings;
		$this->code = $previous->getCode();
		$this->message = $this->formatMessage($sql, $bindings, $previous);

		if ($previous instanceof \PDOException) {
			$this->errorInfo = $previous->errorInfo;
		}
	}

	protected function formatMessage($sql, $bindings, $previous)
	{
		return $previous->getMessage() . ' (SQL: ' . \Illuminate\Support\Str::replaceArray('?', $bindings, $sql) . ')';
	}

	public function getSql()
	{
		return $this->sql;
	}

	public function getBindings()
	{
		return $this->bindings;
	}
}

?>
