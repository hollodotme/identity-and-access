<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;

/**
 * Interface RetrievesEventStream
 * @package hollodotme\EventStore\Interfaces
 */
interface RetrievesEventStream
{
	public function retrieveEntityStream(
		StreamName $streamName, StreamId $streamId, StreamSequence $fromSequence
	) : EventStream;

	public function retrieveNamedStream( StreamName $streamName ) : EventStream;

	public function retrieveFullStream() : EventStream;
}
