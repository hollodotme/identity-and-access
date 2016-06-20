<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models;

use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Types\ActorName;
use hollodotme\EventStore\Types\EventHeader;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\OccurredOn;
use hollodotme\EventStore\Types\ServerId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Domain\EventEnvelope;
use hollodotme\IdentityAndAccess\Domain\Exceptions\AggregateReconstitutedWithoutHistory;

/**
 * Class AbstractAggregateRoot
 * @package hollodotme\IdentityAndAccess\Domain\Models
 */
abstract class AbstractAggregateRoot
{
	/** @var EventStream */
	private $eventStream;

	/** @var StreamSequence */
	private $streamSequence;

	final protected function __construct()
	{
		$this->streamSequence = new StreamSequence( 0 );
		$this->eventStream    = new EventStream();
	}

	final public static function reconstitute( EventStream $eventStream ) : static
	{
		if ( $eventStream->isEmpty() )
		{
			throw new AggregateReconstitutedWithoutHistory();
		}

		$instance = new static();

		foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
		{
			$instance->apply( $eventEnvelope );
		}

		return $instance;
	}

	private function apply( EnclosesEvent $eventEnvelope )
	{
		$header = $eventEnvelope->getHeader();
		$event  = $eventEnvelope->getEvent();

		$this->streamSequence = $header->getStreamSequence();

		$methodName = 'when%s' . $event->getId()->toString();

		if ( method_exists( $this, $methodName ) )
		{
			call_user_func( [ $this, $methodName ], $event );
		}
	}

	final protected function trackThat( ImpliesChange $event )
	{
		$eventEnvelope = $this->getEventEnvelope( $event );

		$this->eventStream->addEventEnvelope( $eventEnvelope );

		$this->apply( $eventEnvelope );
	}

	final protected function getEventEnvelope( ImpliesChange $event ) : EnclosesEvent
	{
		$header = new EventHeader(
			$this->getStreamName(),
			$event->getStreamId(),
			$this->streamSequence->increment(),
			new OccurredOn( new \DateTimeImmutable() ),
			new ActorName( $_SERVER['USER'] ? : '' ),
			new ServerId( $_SERVER['SERVER_ADDR'] )
		);

		return new EventEnvelope( $header, $event );
	}

	protected function getStreamName() : StreamName
	{
		return StreamName::fromClassName( static::class );
	}

	final public function getChanges() : EventStream
	{
		return $this->eventStream;
	}

	final public function clearChanges()
	{
		$this->eventStream = new EventStream();
	}
}