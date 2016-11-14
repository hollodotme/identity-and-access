<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Configs;

/**
 * Class ProjectionRedisConfig
 * @package hollodotme\IdentityAndAccess\Infrastructure\Configs
 */
final class ProjectionRedisConfig
{
	/** @var array */
	private $configData;

	public function __construct()
	{
		$this->configData = require(__DIR__ . '/../../../configs/ProjectionRedis.php');
	}

	public function getHost() : string
	{
		return $this->configData['host'];
	}

	public function getPort() : int
	{
		return $this->configData['port'];
	}

	public function getDatabase() : int
	{
		return $this->configData['database'];
	}

	public function getTimeout() : float
	{
		return $this->configData['timeout'];
	}

	public function getPrefix() : string
	{
		return $this->configData['prefix'];
	}

	public function getPassword()
	{
		return $this->configData['password'];
	}
}
