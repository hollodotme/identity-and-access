<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services\EventMaps;

use hollodotme\EventStore\Types\EventId;
use hollodotme\IdentityAndAccess\Domain\Exceptions\LookingUpClassNameFailed;
use hollodotme\IdentityAndAccess\Domain\Services\Interfaces\MapsEventClassName;

/**
 * Class AbstractEventMap
 * @package hollodotme\IdentityAndAccess\Domain\Services\EventMaps
 */
abstract class AbstractEventMap implements MapsEventClassName
{
	const MAP = [ ];

	public function lookUpClassName( EventId $eventId ) : string
	{
		echo '<pre>', htmlspecialchars( print_r( static::MAP, 1 ) ), '</pre>';

		if ( array_key_exists( $eventId->toString(), static::MAP ) )
		{
			return static::MAP[ $eventId->toString() ];
		}

		throw ( new LookingUpClassNameFailed() )->withEventId( $eventId );
	}
}