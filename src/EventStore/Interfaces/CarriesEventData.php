<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventName;
use hollodotme\EventStore\Types\EventPayload;

/**
 * Interface CarriesEventData
 * @package hollodotme\EventStore\Interfaces
 */
interface CarriesEventData
{
	public function getId() : EventId;

	public function getName() : EventName;

	public function getPayload() : EventPayload;

	public static function newFromPayload( EventPayload $eventPayload ) : CarriesEventData;
}