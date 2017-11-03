<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Connectors;

class MySqlConnector extends Connector implements ConnectorInterface
{
	public function connect(array $config)
	{
		$dsn = $this->getDsn($config);
		$options = $this->getOptions($config);
		$connection = $this->createConnection($dsn, $config, $options);

		if (!empty($config['database'])) {
			$connection->exec('use `' . $config['database'] . '`;');
		}

		$this->configureEncoding($connection, $config);
		$this->configureTimezone($connection, $config);
		$this->setModes($connection, $config);
		return $connection;
	}

	protected function configureEncoding($connection, array $config)
	{
		if (!isset($config['charset'])) {
			return $connection;
		}

		$connection->prepare('set names \'' . $config['charset'] . '\'' . $this->getCollation($config))->execute();
	}

	protected function getCollation(array $config)
	{
		return isset($config['collation']) ? ' collate \'' . $config['collation'] . '\'' : '';
	}

	protected function configureTimezone($connection, array $config)
	{
		if (isset($config['timezone'])) {
			$connection->prepare('set time_zone="' . $config['timezone'] . '"')->execute();
		}
	}

	protected function getDsn(array $config)
	{
		return $this->hasSocket($config) ? $this->getSocketDsn($config) : $this->getHostDsn($config);
	}

	protected function hasSocket(array $config)
	{
		return isset($config['unix_socket']) && !empty($config['unix_socket']);
	}

	protected function getSocketDsn(array $config)
	{
		return 'mysql:unix_socket=' . $config['unix_socket'] . ';dbname=' . $config['database'];
	}

	protected function getHostDsn(array $config)
	{
		extract($config, EXTR_SKIP);
		return isset($port) ? 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database : 'mysql:host=' . $host . ';dbname=' . $database;
	}

	protected function setModes(\PDO $connection, array $config)
	{
		if (isset($config['modes'])) {
			$this->setCustomModes($connection, $config);
		}
		else if (isset($config['strict'])) {
			if ($config['strict']) {
				$connection->prepare($this->strictMode())->execute();
			}
			else {
				$connection->prepare('set session sql_mode=\'NO_ENGINE_SUBSTITUTION\'')->execute();
			}
		}
	}

	protected function setCustomModes(\PDO $connection, array $config)
	{
		$modes = implode(',', $config['modes']);
		$connection->prepare('set session sql_mode=\'' . $modes . '\'')->execute();
	}

	protected function strictMode()
	{
		return 'set session sql_mode=\'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION\'';
	}
}

?>
