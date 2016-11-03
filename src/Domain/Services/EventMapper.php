<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services;

use hollodotme\EventStore\AbstractEventMapper;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Exceptions\LoadingEventMapFailed;
use hollodotme\IdentityAndAccess\Domain\Exceptions\LookingUpClassNameFailed;
use hollodotme\IdentityAndAccess\Domain\Services\Interfaces\MapsEventClassName;

/**
 * Class EventMapper
 * @package hollodotme\IdentityAndAccess\Application
 */
final class EventMapper extends AbstractEventMapper
{
	/** @var array */
	private $maps;

	public function __construct()
	{
		$this->maps = [ ];
	}

	/**
	 * @param StreamName $streamName
	 * @param EventId    $eventId
	 *
	 * @throws LoadingEventMapFailed
	 * @throws LookingUpClassNameFailed
	 * @return string
	 */
	protected function getEventClass( StreamName $streamName, EventId $eventId ) : string
	{
		$key = $streamName->toString();

		if ( !isset($this->maps[ $key ]) )
		{
			$this->maps[ $key ] = $this->loadMap( $streamName );
		}

		return $this->maps[ $key ]->lookUpClassName( $eventId );
	}

	/**
	 * @param StreamName $streamName
	 *
	 * @throws LoadingEventMapFailed
	 * @return MapsEventClassName
	 */
	private function loadMap( StreamName $streamName ) : MapsEventClassName
	{
		$className = __NAMESPACE__ . '\\EventMaps\\' . $streamName->toString() . 'sEventMap';

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
