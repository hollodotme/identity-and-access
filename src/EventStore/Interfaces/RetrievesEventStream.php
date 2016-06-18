<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;

/**
 * Interface RetrievesEventStream
 * @package hollodotme\EventStore\Interfaces
 */
interface RetrievesEventStream
{
	public function retrieveEventStream(
		StreamName $streamName, StreamId $streamId, MapsEvent $eventMapper
	) : EventStream;
}