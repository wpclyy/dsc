<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Connectors;

class PostgresConnector extends Connector implements ConnectorInterface
{
	/**
     * The default PDO connection options.
     *
     * @var array
     */
	protected $options = array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_ORACLE_NULLS => \PDO::NULL_NATURAL, \PDO::ATTR_STRINGIFY_FETCHES => false);

	public function connect(array $config)
	{
		$connection = $this->createConnection($this->getDsn($config), $config, $this->getOptions($config));
		$this->configureEncoding($connection, $config);
		$this->configureTimezone($connection, $config);
		$this->configureSchema($connection, $config);
		$this->configureApplicationName($connection, $config);
		return $connection;
	}

	protected function configureEncoding($connection, $config)
	{
		$charset = $config['charset'];
		$connection->prepare('set names \'' . $charset . '\'')->execute();
	}

	protected function configureTimezone($connection, array $config)
	{
		if (isset($config['timezone'])) {
			$timezone = $config['timezone'];
			$connection->prepare('set time zone \'' . $timezone . '\'')->execute();
		}
	}

	protected function configureSchema($connection, $config)
	{
		if (isset($config['schema'])) {
			$schema = $this->formatSchema($config['schema']);
			$connection->prepare('set search_path to ' . $schema)->execute();
		}
	}

	protected function formatSchema($schema)
	{
		if (is_array($schema)) {
			return '"' . implode('", "', $schema) . '"';
		}
		else {
			return '"' . $schema . '"';
		}
	}

	protected function configureApplicationName($connection, $config)
	{
		if (isset($config['application_name'])) {
			$applicationName = $config['application_name'];
			$connection->prepare('set application_name to \'' . $applicationName . '\'')->execute();
		}
	}

	protected function getDsn(array $config)
	{
		extract($config, EXTR_SKIP);
		$host = (isset($host) ? 'host=' . $host . ';' : '');
		$dsn = 'pgsql:' . $host . 'dbname=' . $database;

		if (isset($config['port'])) {
			$dsn .= ';port=' . $port;
		}

		return $this->addSslOptions($dsn, $config);
	}

	protected function addSslOptions($dsn, array $config)
	{
		foreach (array('sslmode', 'sslcert', 'sslkey', 'sslrootcert') as $option) {
			if (isset($config[$option])) {
				$dsn .= ';' . $option . '=' . $config[$option];
			}
		}

		return $dsn;
	}
}

?>
