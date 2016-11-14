<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis;

/**
 * Class RedisManager
 * @package hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis
 */
final class RedisManager extends \Redis
{
	public function __construct( RedisConnection $connection )
	{
		parent::__construct();

		$this->initConnection( $connection );
	}

	private function initConnection( RedisConnection $connection )
	{
		$this->connect( $connection->getHost(), $connection->getPort(), $connection->getTimeout() );

		if ( null !== $connection->getPassword() )
		{
			$this->auth( $connection->getPassword() );
		}

		foreach ( $connection->getOptions() as $name => $option )
		{
			$this->setOption( $name, $option );
		}

		$this->select( $connection->getDatabase() );
	}
}
