<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\EventStore;
use hollodotme\EventStore\Interfaces\MapsEvent;

/**
 * Class AbstractRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
abstract class AbstractRepository
{
	/** @var EventStore */
	private $eventStore;

	/** @var MapsEvent */
	private $eventMapper;

	final public function __construct( EventStore $eventStore, MapsEvent $eventMapper )
	{
		$this->eventStore  = $eventStore;
		$this->eventMapper = $eventMapper;
	}

	final protected function getEventStore() : EventStore
	{
		return $this->eventStore;
	}

	final protected function getEventMapper() : MapsEvent
	{
		return $this->eventMapper;
	}
}