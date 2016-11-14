<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis;

/**
 * Class RedisConnection
 * @package hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis
 */
final class RedisConnection
{
	/** @var string */
	private $host;

	/** @var int */
	private $port;

	/** @var int */
	private $database;

	/** @var float */
	private $timeout;

	/** @var string */
	private $prefix;

	/** @var null|string */
	private $password;

	public function __construct(
		string $host, int $port, int $database, float $timeout, string $prefix, string $password = null
	)
	{
		$this->host     = $host;
		$this->port     = $port;
		$this->database = $database;
		$this->timeout  = $timeout;
		$this->prefix   = $prefix;
		$this->password = $password;
	}

	public function getHost(): string
	{
		return $this->host;
	}

	public function getPort(): int
	{
		return $this->port;
	}

	public function getDatabase(): int
	{
		return $this->database;
	}

	public function getTimeout(): float
	{
		return $this->timeout;
	}

	public function getPrefix(): string
	{
		return $this->prefix;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getOptions() : array
	{
		return [
			\Redis::OPT_PREFIX       => $this->prefix,
			\Redis::OPT_READ_TIMEOUT => (string)$this->timeout,
			\Redis::OPT_SERIALIZER   => (string)\Redis::SERIALIZER_NONE,
		];
	}
}
