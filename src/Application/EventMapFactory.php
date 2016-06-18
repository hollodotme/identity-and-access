<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\Exceptions\LoadingEventMapFailed;
use hollodotme\IdentityAndAccess\Application\Interfaces\MapsEventClassName;

/**
 * Class EventMapFactory
 * @package hollodotme\IdentityAndAccess\Application
 */
final class EventMapFactory
{
	/**
	 * @param StreamName $streamName
	 *
	 * @throws LoadingEventMapFailed
	 * @return MapsEventClassName
	 */
	public function loadMap( StreamName $streamName ) : MapsEventClassName
	{
		$className = __NAMESPACE__ . '\\EventMaps\\' . $streamName->toString();

		try
		{
			$refClass = new \ReflectionClass( $className );
		}
		catch ( \ReflectionException $e )
		{
			throw ( new LoadingEventMapFailed() )->withStreamName( $streamName );
		}

		if ( !$refClass->implementsInterface( MapsEventClassName::class ) )
		{
			throw ( new LoadingEventMapFailed() )->withStreamName( $streamName );
		}

		return $refClass->newInstance();
	}
}