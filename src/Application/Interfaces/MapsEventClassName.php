<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Interfaces;

use hollodotme\EventStore\Types\EventId;

/**
 * Interface MapsEventClassName
 * @package hollodotme\IdentityAndAccess\Application\Interfaces
 */
interface MapsEventClassName
{
	public function lookUpClassName( EventId $eventId ) : string;
}