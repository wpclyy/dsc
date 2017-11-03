<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Database\Connectors;

class SQLiteConnector extends Connector implements ConnectorInterface
{
	public function connect(array $config)
	{
		$options = $this->getOptions($config);

		if ($config['database'] == ':memory:') {
			return $this->createConnection('sqlite::memory:', $config, $options);
		}

		$path = realpath($config['database']);

		if ($path === false) {
			throw new \InvalidArgumentException('Database (' . $config['database'] . ') does not exist.');
		}

		return $this->createConnection('sqlite:' . $path, $config, $options);
	}
}

?>
