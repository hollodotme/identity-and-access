<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventHeader;

/**
 * Interface EnclosesEvent
 * @package hollodotme\EventStore\Interfaces
 */
interface EnclosesEvent
{
	public function getHeader() : EventHeader;

	public function getEvent() : CarriesEventData;
}