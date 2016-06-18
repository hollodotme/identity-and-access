<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models;

use hollodotme\EventStore\EventEnvelope;
use hollodotme\EventStore\Interfaces\CarriesEventData;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Types\ActorName;
use hollodotme\EventStore\Types\EventHeader;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\OccurredOn;
use hollodotme\EventStore\Types\ServerId;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;

/**
 * Class AbstractAggregateRoot
 * @package hollodotme\IdentityAndAccess\Domain\Models
 */
abstract class AbstractAggregateRoot
{
	/** @var StreamSequence */
	private $streamSequence;

	final public function __construct( EventStream $eventStream )
	{
		$this->streamSequence = new StreamSequence( 0 );

		foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
		{
			$this->apply( $eventEnvelope );
		}
	}

	private function apply( EnclosesEvent $eventEnvelope )
	{
		$header = $eventEnvelope->getHeader();
		$event  = $eventEnvelope->getEvent();

		$this->streamSequence = $header->getStreamSequence();

		$methodName = sprintf( 'when%s', preg_replace( "#Event$#", '', $event->getId()->toString() ) );
		if ( method_exists( $this, $methodName ) )
		{
			call_user_func( $methodName, $event );
		}
	}

	final public function publish( CarriesEventData $event )
	{
		$header = new EventHeader(
			$this->getStreamName(),
			$this->getStreamId(),
			$this->streamSequence->increment(),
			new OccurredOn( new \DateTimeImmutable() ),
			new ActorName( $_SERVER['USER'] ? : '' ),
			new ServerId( $_SERVER['SERVER_ADDR'] )
		);

		$eventEnvelope = new EventEnvelope( $header, $event );

		$this->apply( $eventEnvelope );
	}

	public function getStreamName() : StreamName
	{
		return StreamName::fromClassName( static::class );
	}

	abstract public function getStreamId() : StreamId;
}