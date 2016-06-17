<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Exceptions\EventStoreException;
use hollodotme\EventStore\Exceptions\MappingEventFailed;
use hollodotme\EventStore\Interfaces\CarriesEventData;
use hollodotme\EventStore\Interfaces\MapsEvent;

/**
 * Class AbstractEventMapper
 * @package hollodotme\EventStore
 */
abstract class AbstractEventMapper implements MapsEvent
{
	public function mapEvent( EventHeader $header, EventId $eventId, EventPayload $eventPayload ) : CarriesEventData
	{
		try
		{
			$eventClass = $this->getEventClass( $header->getStreamName(), $eventId );

			$refEventClass = new \ReflectionClass( $eventClass );

			$this->guardEventClassIsValid( $refEventClass );

			$event = $refEventClass->getMethod( 'newFromPayload' )->invoke( null, $eventPayload );

			return $event;
		}
		catch ( \Throwable $e )
		{
			throw ( new MappingEventFailed( $e->getMessage() ) )->with( $header->getStreamName(), $eventId );
		}
	}

	abstract protected function getEventClass( StreamName $streamName, EventId $eventId ) : string;

	/**
	 * @param \ReflectionClass $eventClass
	 *
	 * @throws EventStoreException
	 */
	private function guardEventClassIsValid( \ReflectionClass $eventClass )
	{
		if ( !$eventClass->implementsInterface( CarriesEventData::class ) )
		{
			throw new EventStoreException( 'Invalid event class: ' . $eventClass );
		}
	}
}