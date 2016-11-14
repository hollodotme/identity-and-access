<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Configs;

/**
 * Class EventStoreMySqlConfig
 * @package hollodotme\IdentityAndAccess\Infrastructure\Configs
 */
final class EventStoreMySqlConfig
{
	/** @var array */
	private $configData;

	public function __construct()
	{
		$this->configData = require(__DIR__ . '/../../../configs/EventStoreMySql.php');
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
