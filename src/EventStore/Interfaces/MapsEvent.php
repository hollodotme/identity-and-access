<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventHeader;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventPayload;

/**
 * Interface MapsEvent
 * @package hollodotme\EventStore\Interfaces
 */
interface MapsEvent
{
	public function mapEvent( EventHeader $header, EventId $eventId, EventPayload $eventPayload ) : ImpliesChange;
}