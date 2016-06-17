<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\EventStream;
use hollodotme\EventStore\StreamId;
use hollodotme\EventStore\StreamName;

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