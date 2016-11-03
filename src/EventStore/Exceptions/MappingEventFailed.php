<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Exceptions;

use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;

/**
 * Class MappingEventFailed
 * @package hollodotme\EventStore\Exceptions
 */
final class MappingEventFailed extends EventStoreException
{
	/** @var StreamName */
	private $streamName;

	/** @var EventId */
	private $eventId;

	public function with( StreamName $streamName, EventId $eventId ) : self
	{
		$this->streamName = $streamName;
		$this->eventId    = $eventId;

		return $this;
	}

	public function getStreamName() : StreamName
	{
		return $this->streamName;
	}

	public function getEventId() : EventId
	{
		return $this->eventId;
	}
}
