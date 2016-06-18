<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\EventStore\Adapters\MySql\MySqlAdapter;
use hollodotme\EventStore\Adapters\MySql\MySqlConnection;
use hollodotme\EventStore\EventStore;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\IdentityAndAccess\Application\Configs\MySqlConfig;

/**
 * Class EventBus
 * @package hollodotme\IdentityAndAccess\Application
 */
final class EventBus
{
	/** @var EventStream */
	private $eventStream;

	/** @var EventStore */
	private $eventStore;

	public function __construct()
	{
		$this->eventStream = new EventStream();

		$mySqlConfig     = new MySqlConfig();
		$mySqlConnection = new MySqlConnection(
			$mySqlConfig->getHost(),
			$mySqlConfig->getPort(),
			$mySqlConfig->getDatabase(),
			$mySqlConfig->getUsername(),
			$mySqlConfig->getPassword()
		);

		$mySqlAdapter = new MySqlAdapter( $mySqlConnection );

		$this->eventStore = new EventStore( $mySqlAdapter );
	}

	public static function singleton() : self
	{
		static $instance = null;

		if ( $instance === null )
		{
			$instance = new self();
		}

		return $instance;
	}

	public function publish( EnclosesEvent $eventEnvelope )
	{
		$this->eventStream->addEventEnvelope( $eventEnvelope );
	}
}