<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\EventStore\Adapters\MySql\MySqlAdapter;
use hollodotme\EventStore\Adapters\MySql\MySqlConnection;
use hollodotme\EventStore\EventStore;
use hollodotme\IdentityAndAccess\Application\Configs\MySqlConfig;
use hollodotme\IdentityAndAccess\Domain\Repositories\ApplicationsRepository;
use hollodotme\IdentityAndAccess\Domain\Repositories\TenantsRepository;
use hollodotme\IdentityAndAccess\Domain\Repositories\UsersRepository;
use hollodotme\PubSub\MessageBus;

/**
 * Class DomainManager
 * @package hollodotme\IdentityAndAccess\Application
 */
final class DomainManager
{
	/** @var EventStore */
	private $eventStore;

	/** @var MessageBus */
	private $messageBus;

	/** @var array */
	private $repositories;

	public function __construct()
	{
		$mySqlConfig = new MySqlConfig();
		$connection  = new MySqlConnection(
			$mySqlConfig->getHost(),
			$mySqlConfig->getPort(),
			$mySqlConfig->getDatabase(),
			$mySqlConfig->getUsername(),
			$mySqlConfig->getPassword()
		);

		$eventEnvelopeBuilder = new EventEnvelopeBuilder( new EventMapper() );
		$mySqlAdapter         = new MySqlAdapter( $connection, $eventEnvelopeBuilder );

		$this->eventStore   = new EventStore( $mySqlAdapter );
		$this->messageBus   = new MessageBus();
		$this->repositories = [ ];
	}

	public function getApplicationsRepository() : ApplicationsRepository
	{
		if ( !isset($this->repositories[ ApplicationsRepository::class ]) )
		{
			$this->repositories[ ApplicationsRepository::class ] = new ApplicationsRepository(
				$this->eventStore, $this->messageBus
			);
		}

		return $this->repositories[ ApplicationsRepository::class ];
	}

	public function getTenantsRepository() : TenantsRepository
	{
		if ( !isset($this->repositories[ TenantsRepository::class ]) )
		{
			$this->repositories[ TenantsRepository::class ] = new TenantsRepository(
				$this->eventStore, $this->messageBus
			);
		}

		return $this->repositories[ TenantsRepository::class ];
	}

	public function getusersRepository() : UsersRepository
	{
		if ( !isset($this->repositories[ UsersRepository::class ]) )
		{
			$this->repositories[ UsersRepository::class ] = new UsersRepository(
				$this->eventStore, $this->messageBus
			);
		}

		return $this->repositories[ UsersRepository::class ];
	}
}