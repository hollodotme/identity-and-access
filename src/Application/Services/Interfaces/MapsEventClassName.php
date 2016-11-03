<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services\Interfaces;

use hollodotme\EventStore\Types\EventId;

/**
 * Interface MapsEventClassName
 * @package hollodotme\IdentityAndAccess\Application\Services\Interfaces
 */
interface MapsEventClassName
{
	public function lookUpClassName( EventId $eventId ) : string;
}
