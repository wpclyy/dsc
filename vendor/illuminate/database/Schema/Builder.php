<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Schema;

class Builder
{
	/**
     * The database connection instance.
     *
     * @var \Illuminate\Database\Connection
     */
	protected $connection;
	/**
     * The schema grammar instance.
     *
     * @var \Illuminate\Database\Schema\Grammars\Grammar
     */
	protected $grammar;
	/**
     * The Blueprint resolver callback.
     *
     * @var \Closure
     */
	protected $resolver;
	/**
     * The default string length for migrations.
     *
     * @var int
     */
	static public $defaultStringLength = 255;

	public function __construct(\Illuminate\Database\Connection $connection)
	{
		$this->connection = $connection;
		$this->grammar = $connection->getSchemaGrammar();
	}

	static public function defaultStringLength($length)
	{
		static::$defaultStringLength = $length;
	}

	public function hasTable($table)
	{
		$table = $this->connection->getTablePrefix() . $table;
		return 0 < count($this->connection->select($this->grammar->compileTableExists(), array($table)));
	}

	public function hasColumn($table, $column)
	{
		return in_array(strtolower($column), array_map('strtolower', $this->getColumnListing($table)));
	}

	public function hasColumns($table, array $columns)
	{
		$tableColumns = array_map('strtolower', $this->getColumnListing($table));

		foreach ($columns as $column) {
			if (!in_array(strtolower($column), $tableColumns)) {
				return false;
			}
		}

		return true;
	}

	public function getColumnType($table, $column)
	{
		$table = $this->connection->getTablePrefix() . $table;
		return $this->connection->getDoctrineColumn($table, $column)->getType()->getName();
	}

	public function getColumnListing($table)
	{
		$table = $this->connection->getTablePrefix() . $table;
		$results = $this->connection->select($this->grammar->compileColumnListing($table));
		return $this->connection->getPostProcessor()->processColumnListing($results);
	}

	public function table($table, \Closure $callback)
	{
		$this->build($this->createBlueprint($table, $callback));
	}

	public function create($table, \Closure $callback)
	{
		$this->build(tap($this->createBlueprint($table), function($blueprint) use($callback) {
			$blueprint->create();
			$callback($blueprint);
		}));
	}

	public function drop($table)
	{
		$this->build(tap($this->createBlueprint($table), function($blueprint) {
			$blueprint->drop();
		}));
	}

	public function dropIfExists($table)
	{
		$this->build(tap($this->createBlueprint($table), function($blueprint) {
			$blueprint->dropIfExists();
		}));
	}

	public function rename($from, $to)
	{
		$this->build(tap($this->createBlueprint($from), function($blueprint) use($to) {
			$blueprint->rename($to);
		}));
	}

	public function enableForeignKeyConstraints()
	{
		return $this->connection->statement($this->grammar->compileEnableForeignKeyConstraints());
	}

	public function disableForeignKeyConstraints()
	{
		return $this->connection->statement($this->grammar->compileDisableForeignKeyConstraints());
	}

	protected function build(Blueprint $blueprint)
	{
		$blueprint->build($this->connection, $this->grammar);
	}

	protected function createBlueprint($table, \Closure $callback = NULL)
	{
		if (isset($this->resolver)) {
			return call_user_func($this->resolver, $table, $callback);
		}

		return new Blueprint($table, $callback);
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function setConnection(\Illuminate\Database\Connection $connection)
	{
		$this->connection = $connection;
		return $this;
	}

	public function blueprintResolver(\Closure $resolver)
	{
		$this->resolver = $resolver;
	}
}


?>
