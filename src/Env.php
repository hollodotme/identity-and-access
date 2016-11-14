<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess;

use hollodotme\EventStore\EventStore;
use hollodotme\IdentityAndAccess\Application\Constants\Stream;
use hollodotme\IdentityAndAccess\Application\ReadModel\Tenants\TenantsProjector;
use hollodotme\IdentityAndAccess\Application\Services\EventEnvelopeBuilder;
use hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers\RegisterTenantCommandHandler;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterTenantCommand;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlAdapter;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlConnection;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis\RedisConnection;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis\RedisManager;
use hollodotme\IdentityAndAccess\Infrastructure\Configs\EventStoreMySqlConfig;
use hollodotme\IdentityAndAccess\Infrastructure\Configs\ProjectionRedisConfig;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus;
use IceHawk\PubSub\MessageBus;
use IceHawk\PubSub\Types\Channel;

/**
 * Class Env
 * @package hollodotme\IdentityAndAccess
 */
final class Env extends AbstractObjectPool
{
	public function getEventStore() : EventStore
	{
		return $this->getSharedObject(
			'eventStore',
			function ()
			{
				$mysqlConfig     = new EventStoreMySqlConfig();
				$mysqlConnection = new MySqlConnection(
					$mysqlConfig->getHost(),
					$mysqlConfig->getPort(),
					$mysqlConfig->getDatabase(),
					$mysqlConfig->getUsername(),
					$mysqlConfig->getPassword()
				);
				$mysqlAdapter    = new MySqlAdapter( $mysqlConnection, new EventEnvelopeBuilder() );

				$eventStore = new EventStore( $mysqlAdapter );

				return $eventStore;
			}
		);
	}

	public function getCommandBus() : CommandBus
	{
		return $this->getSharedObject(
			'commandBus',
			function ()
			{
				$commandBus = new CommandBus();
				$commandBus->registerCommandHandler(
					RegisterTenantCommand::class,
					RegisterTenantCommandHandler::class
				);

				return $commandBus;
			}
		);
	}

	public function getMessageBus() : MessageBus
	{
		return $this->getSharedObject(
			'messageBus',
			function ()
			{
				$messageBus = new MessageBus();

				$messageBus->subscribe(
					new Channel( Stream::TENANT ),
					new TenantsProjector( $this->getRedisManager() )
				);

				return $messageBus;
			}
		);
	}

	public function getRedisManager() : RedisManager
	{
		return $this->getSharedObject(
			'redisManager',
			function ()
			{
				$redisConfig     = new ProjectionRedisConfig();
				$redisConnection = new RedisConnection(
					$redisConfig->getHost(),
					$redisConfig->getPort(),
					$redisConfig->getDatabase(),
					$redisConfig->getTimeout(),
					$redisConfig->getPrefix(),
					$redisConfig->getPassword()
				);

				$redisManager = new RedisManager( $redisConnection );

				return $redisManager;
			}
		);
	}
}
