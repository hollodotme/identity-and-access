<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Configs;

/**
 * Class MySqlConfig
 * @package hollodotme\IdentityAndAccess\Application\Configs
 */
final class MySqlConfig
{
	/** @var array */
	private $configData;

	public function __construct()
	{
		$this->configData = require(__DIR__ . '/../../../configs/MySql.php');
	}

	public function getHost() : string
	{
		return $this->configData['host'];
	}

	public function getPort() : int
	{
		return $this->configData['port'];
	}

	public function getDatabase() : string
	{
		return $this->configData['database'];
	}

	public function getUsername() : string
	{
		return $this->configData['username'];
	}

	public function getPassword() : string
	{
		return $this->configData['password'];
	}
}