<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\EventHeader;
use hollodotme\EventStore\EventId;
use hollodotme\EventStore\EventPayload;

/**
 * Interface MapsEvent
 * @package hollodotme\EventStore\Interfaces
 */
interface MapsEvent
{
	public function mapEvent( EventHeader $header, EventId $eventId, EventPayload $eventPayload ) : CarriesEventData;
}