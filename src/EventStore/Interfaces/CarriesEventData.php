<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\EventId;
use hollodotme\EventStore\EventName;
use hollodotme\EventStore\EventPayload;

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