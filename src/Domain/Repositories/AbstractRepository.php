<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\PubSub\Interfaces\DispatchesMessages;

/**
 * Class AbstractRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
abstract class AbstractRepository
{
	/** @var StoresEventStream */
	private $eventStore;

	/** @var DispatchesMessages */
	private $messageBus;

	final public function __construct( StoresEventStream $eventStore, DispatchesMessages $messageBus )
	{
		$this->eventStore = $eventStore;
		$this->messageBus = $messageBus;
	}

	final protected function getEventStore() : StoresEventStream
	{
		return $this->eventStore;
	}

	final public function saveChanges( AbstractAggregateRoot $aggregateRoot )
	{
		$eventStream = $aggregateRoot->getChanges();

		$this->eventStore->persistEventStream( $eventStream );

		foreach ( $eventStream as $eventEnvelope )
		{
			$this->messageBus->publish( $eventEnvelope );
		}

		$aggregateRoot->clearChanges();
	}
}