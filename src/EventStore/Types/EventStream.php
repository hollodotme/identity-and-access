<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\EnclosesEvent;

/**
 * Class EventStream
 * @package hollodotme\EventStore\Types
 */
final class EventStream
{
	/** @var \Generator|EnclosesEvent[] */
	private $eventEnvelopes;

	public function __construct( \Generator $eventEnvelopes = null )
	{
		$this->eventEnvelopes = $eventEnvelopes ? : $this->emptyEmptyEnvelopes();
	}

	public function addEventEnvelope( EnclosesEvent $eventEnvelope )
	{
		if ( $this->eventEnvelopes === null )
		{
			$this->eventEnvelopes = $this->newEnvelopes( $eventEnvelope );
		}
		else
		{
			$this->eventEnvelopes = $this->mergeEnvelopes( $this->eventEnvelopes, $eventEnvelope );
		}
	}

	private function emptyEmptyEnvelopes(): \Generator
	{
		yield from [];
	}

	private function newEnvelopes( EnclosesEvent $enclosesEvent ): \Generator
	{
		yield $enclosesEvent;
	}

	private function mergeEnvelopes( \Generator $eventEnvelopes, EnclosesEvent $eventEnvelope ): \Generator
	{
		yield from $eventEnvelopes;

		yield $eventEnvelope;
	}

	public function merge( EventStream $eventStream ): EventStream
	{
		$mergedStream = new self( $this->getEventEnvelopes() );

		foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
		{
			$mergedStream->addEventEnvelope( $eventEnvelope );
		}

		return $mergedStream;
	}

	/**
	 * @return \Generator|EnclosesEvent[]
	 */
	public function getEventEnvelopes(): \Generator
	{
		yield from $this->eventEnvelopes;
	}
}
