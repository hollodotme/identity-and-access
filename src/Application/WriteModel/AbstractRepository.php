<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel;

use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\EventStore\Types\EventStream;
use IceHawk\PubSub\Interfaces\DispatchesMessages;
use IceHawk\PubSub\Types\Channel;

/**
 * Class AbstractRepository
 * @package hollodotme\IdentityAndAccess\Application\WriteModel
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

	final protected function getEventStore(): StoresEventStream
	{
		return $this->eventStore;
	}

	final public function saveChanges( AbstractAggregateRoot $aggregateRoot )
	{
		$eventStream        = $aggregateRoot->getChanges();
		$eventEnvelopes     = iterator_to_array( $eventStream->getEventEnvelopes() );
		$persistEventStream = new EventStream();

		foreach ( $eventEnvelopes as $envelope )
		{
			$persistEventStream->addEventEnvelope( $envelope );
		}

		$this->eventStore->persistEventStream( $persistEventStream );

		/** @var EventEnvelope $eventEnvelope */
		foreach ( $eventEnvelopes as $eventEnvelope )
		{
			$this->messageBus->publish( $this->getChannel(), $eventEnvelope );
		}

		$aggregateRoot->clearChanges();
	}

	abstract protected function getChannel(): Channel;
}
