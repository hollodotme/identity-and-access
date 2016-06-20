<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;

/**
 * Class EventStore
 * @package hollodotme\EventStore
 */
final class EventStore implements StoresEventStream
{
	/** @var StoresEventStream */
	private $adapter;

	public function __construct( StoresEventStream $adapter )
	{
		$this->adapter = $adapter;
	}

	public function persistEventStream( EventStream $eventStream )
	{
		$this->adapter->persistEventStream( $eventStream );
	}

	public function retrieveEventStream( StreamName $streamName, StreamId $streamId ) : EventStream
	{
		return $this->adapter->retrieveEventStream( $streamName, $streamId );
	}
}