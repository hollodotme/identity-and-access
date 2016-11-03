<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;

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

	public function retrieveEntityStream(
		StreamName $streamName, StreamId $streamId, StreamSequence $fromSequence
	) : EventStream
	{
		return $this->adapter->retrieveEntityStream( $streamName, $streamId, $fromSequence );
	}

	public function retrieveNamedStream( StreamName $streamName ) : EventStream
	{
		return $this->adapter->retrieveNamedStream( $streamName );
	}

	public function retrieveFullStream() : EventStream
	{
		return $this->adapter->retrieveFullStream();
	}
}
