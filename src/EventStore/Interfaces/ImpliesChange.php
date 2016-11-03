<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventName;
use hollodotme\EventStore\Types\EventPayload;
use hollodotme\EventStore\Types\StreamId;

/**
 * Interface ImpliesChange
 * @package hollodotme\EventStore\Interfaces
 */
interface ImpliesChange
{
	public function getStreamId() : StreamId;

	public function getEventId() : EventId;

	public function getEventName() : EventName;

	public function getPayload() : EventPayload;

	public static function newFromPayload( EventPayload $eventPayload ) : ImpliesChange;
}
