<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\PubSub\Interfaces\DispatchesMessages;
use hollodotme\PubSub\Interfaces\SubscribesToMessages;
use hollodotme\PubSub\Types\Channel;

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

		$this->registerSubscribers();
	}

	private function registerSubscribers()
	{
		foreach ( $this->getSubscribers() as $subscriber )
		{
			$this->messageBus->subscribe( $this->getSubscriptionChannel(), $subscriber );
		}
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

	/**
	 * @return array|SubscribesToMessages[]
	 */
	abstract protected function getSubscribers() : array;

	abstract protected function getSubscriptionChannel() : Channel;
}