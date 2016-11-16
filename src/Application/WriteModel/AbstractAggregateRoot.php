<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel;

use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Application\Exceptions\AggregateReconstitutedWithoutHistory;
use hollodotme\IdentityAndAccess\Application\Services\EventEnvelopeBuilder;

/**
 * Class AbstractAggregateRoot
 * @package hollodotme\IdentityAndAccess\Application\WriteModel
 */
abstract class AbstractAggregateRoot
{
	/** @var EventStream */
	private $eventStream;

	/** @var StreamSequence */
	private $streamSequence;

	/** @var EventEnvelopeBuilder */
	private $eventEnvelopeBuilder;

	final protected function __construct()
	{
		$this->streamSequence       = new StreamSequence( 0 );
		$this->eventStream          = new EventStream();
		$this->eventEnvelopeBuilder = new EventEnvelopeBuilder();
	}

	/**
	 * @param EventStream $eventStream
	 *
	 * @throws AggregateReconstitutedWithoutHistory
	 * @return static
	 */
	final public static function reconstitute( EventStream $eventStream )
	{
		$appliedEnvelopes = 0;
		$instance         = new static();

		foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
		{
			$instance->apply( $eventEnvelope );
			$appliedEnvelopes++;
		}

		if ( 0 === $appliedEnvelopes )
		{
			throw new AggregateReconstitutedWithoutHistory();
		}

		return $instance;
	}

	private function apply( EnclosesEvent $eventEnvelope )
	{
		$header = $eventEnvelope->getHeader();
		$event  = $eventEnvelope->getEvent();

		$this->streamSequence = $header->getStreamSequence();

		$methodName = 'when' . $event->getEventId()->toString();

		if ( is_callable( [ $this, $methodName ] ) )
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
		return $this->eventEnvelopeBuilder->fromEvent(
			$this->getStreamName(),
			$this->streamSequence->increment(),
			$event
		);
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
