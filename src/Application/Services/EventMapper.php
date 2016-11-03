<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services;

use hollodotme\EventStore\AbstractEventMapper;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\Exceptions\LoadingEventMapFailed;
use hollodotme\IdentityAndAccess\Application\Services\Interfaces\MapsEventClassName;

/**
 * Class EventMapper
 * @package hollodotme\IdentityAndAccess\Application\Services
 */
final class EventMapper extends AbstractEventMapper
{
	/** @var array */
	private $maps;

	public function __construct()
	{
		$this->maps = [];
	}

	protected function getEventClass( StreamName $streamName, EventId $eventId ) : string
	{
		$key = $streamName->toString();

		if ( !isset($this->maps[ $key ]) )
		{
			$this->maps[ $key ] = $this->loadMap( $streamName );
		}

		return $this->maps[ $key ]->lookUpClassName( $eventId );
	}

	private function loadMap( StreamName $streamName ) : MapsEventClassName
	{
		$className = __NAMESPACE__ . '\\EventMaps\\' . $streamName->toString() . 'sEventMap';

		try
		{
			$refClass = new \ReflectionClass( $className );
		}
		catch ( \ReflectionException $e )
		{
			throw (new LoadingEventMapFailed())->withStreamName( $streamName );
		}

		if ( !$refClass->implementsInterface( MapsEventClassName::class ) )
		{
			throw (new LoadingEventMapFailed())->withStreamName( $streamName );
		}

		/** @var MapsEventClassName $eventMap */
		$eventMap = $refClass->newInstance();

		return $eventMap;
	}
}
