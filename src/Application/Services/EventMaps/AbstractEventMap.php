<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services\EventMaps;

use hollodotme\EventStore\Types\EventId;
use hollodotme\IdentityAndAccess\Application\Exceptions\LookingUpClassNameFailed;
use hollodotme\IdentityAndAccess\Application\Services\Interfaces\MapsEventClassName;

/**
 * Class AbstractEventMap
 * @package hollodotme\IdentityAndAccess\Application\Services\EventMaps
 */
abstract class AbstractEventMap implements MapsEventClassName
{
	const MAP = [];

	public function lookUpClassName( EventId $eventId ) : string
	{
		if ( array_key_exists( $eventId->toString(), static::MAP ) )
		{
			return static::MAP[ $eventId->toString() ];
		}

		throw (new LookingUpClassNameFailed())->withEventId( $eventId );
	}
}
