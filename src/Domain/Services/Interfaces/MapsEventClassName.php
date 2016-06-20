<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services\Interfaces;

use hollodotme\EventStore\Types\EventId;

/**
 * Interface MapsEventClassName
 * @package hollodotme\IdentityAndAccess\Domain\Services\Interfaces
 */
interface MapsEventClassName
{
	public function lookUpClassName( EventId $eventId ) : string;
}