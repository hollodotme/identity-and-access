<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain;

use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventName;
use hollodotme\EventStore\Types\EventPayload;
use hollodotme\EventStore\Types\StreamId;

/**
 * Class AbstractDomainEvent
 * @package hollodotme\IdentityAndAccess\Domain
 */
abstract class AbstractDomainEvent implements ImpliesChange
{
	abstract public function getStreamId() : StreamId;

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

	public static function newFromPayload( EventPayload $eventPayload ) : ImpliesChange
	{
		$event = ( new \ReflectionClass( static::class ) )->newInstanceWithoutConstructor();
		$event->fromPayload( $eventPayload->toArray() );

		return $event;
	}

	abstract protected function fromPayload( array $payload );
}