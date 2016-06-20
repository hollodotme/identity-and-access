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
		$mySqlConfig  = new MySqlConfig();
		$connection   = new MySqlConnection(
			$mySqlConfig->getHost(),
			$mySqlConfig->getPort(),
			$mySqlConfig->getDatabase(),
			$mySqlConfig->getUsername(),
			$mySqlConfig->getPassword()
		);
		$mySqlAdapter = new MySqlAdapter( $connection, new EventMapper() );

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
}