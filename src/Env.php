<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess;

use hollodotme\EventStore\EventStore;
use hollodotme\IdentityAndAccess\Application\Services\EventEnvelopeBuilder;
use hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers\RegisterTenantCommandHandler;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterTenantCommand;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlAdapter;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlConnection;
use hollodotme\IdentityAndAccess\Infrastructure\Configs\MySqlConfig;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus;
use IceHawk\PubSub\MessageBus;

/**
 * Class Env
 * @package hollodotme\IdentityAndAccess
 */
final class Env
{
	/** @var array */
	private $pool;

	public function __construct()
	{
		$this->pool = [];
	}

	public function getEventStore() : EventStore
	{
		return $this->getSharedInstance(
			'eventStore',
			function ()
			{
				$mysqlConfig     = new MySqlConfig();
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

	private function getSharedInstance( string $key, \Closure $creator )
	{
		if ( !isset($this->pool[ $key ]) )
		{
			$this->pool[ $key ] = $creator->call( $this );
		}

		return $this->pool[ $key ];
	}

	public function getCommandBus() : CommandBus
	{
		return $this->getSharedInstance(
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
		return $this->getSharedInstance(
			'messageBus',
			function ()
			{
				$messageBus = new MessageBus();

				return $messageBus;
			}
		);
	}
}
