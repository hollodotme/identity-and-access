<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\MapsEvent;
use hollodotme\EventStore\Interfaces\StoresEventStream;

/**
 * Class EventStore
 * @package hollodotme\EventStore
 */
final class EventStore implements StoresEventStream
{
	/** @var StoresEventStream */
	private $adapter;

	/**
	 * @param StoresEventStream $adapter
	 */
	public function __construct( StoresEventStream $adapter )
	{
		$this->adapter = $adapter;
	}

	public function persistEventStream( EventStream $eventStream )
	{
		$this->adapter->persistEventStream( $eventStream );
	}

	public function retrieveEventStream(
		StreamName $streamName, StreamId $streamId, MapsEvent $eventMapper
	) : EventStream
	{
		return $this->adapter->retrieveEventStream( $streamName, $streamId, $eventMapper );
	}
}