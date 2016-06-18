<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain;

use hollodotme\EventStore\Interfaces\CarriesEventData;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventName;
use hollodotme\EventStore\Types\EventPayload;

/**
 * Class AbstractDomainEvent
 * @package hollodotme\IdentityAndAccess\Domain
 */
abstract class AbstractDomainEvent implements CarriesEventData
{
	public function getId() : EventId
	{
		return EventId::fromEventClassName( static::class );
	}

	public function getName() : EventName
	{
		return EventName::fromEventClassName( static::class );
	}

	public function getPayload() : EventPayload
	{
		return new EventPayload( $this->toPayload() );
	}

	abstract protected function toPayload() : array;

	public static function newFromPayload( EventPayload $eventPayload ) : CarriesEventData
	{
		$event = ( new \ReflectionClass( static::class ) )->newInstanceWithoutConstructor();
		$event->fromPayload( $eventPayload->toArray() );

		return $event;
	}

	abstract protected function fromPayload( array $payload );
}