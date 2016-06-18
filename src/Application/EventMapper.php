<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\EventStore\AbstractEventMapper;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;

/**
 * Class EventMapper
 * @package hollodotme\IdentityAndAccess\Application
 */
final class EventMapper extends AbstractEventMapper
{
	/** @var EventMapFactory */
	private $eventMapFactory;

	/** @var array */
	private $maps;

	public function __construct()
	{
		$this->eventMapFactory = new EventMapFactory();
		$this->maps            = [ ];
	}

	/**
	 * @param StreamName $streamName
	 * @param EventId    $eventId
	 *
	 * @throws Exceptions\LoadingEventMapFailed
	 * @throws Exceptions\LookingUpClassNameFailed
	 * @return string
	 */
	protected function getEventClass( StreamName $streamName, EventId $eventId ) : string
	{
		$key = $streamName->toString();

		if ( !isset($this->maps[ $key ]) )
		{
			$this->maps[ $key ] = $this->eventMapFactory->loadMap( $streamName );
		}

		return $this->maps[ $key ]->lookUpClassName( $eventId );
	}
}