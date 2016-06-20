<?php
/**
 * @author h.woltersdorf
 */

namespace hollodotme\IdentityAndAccess\Domain\Services;

use hollodotme\EventStore\Interfaces\BuildsEventEnvelope;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Interfaces\MapsEvent;
use hollodotme\EventStore\Types\ActorName;
use hollodotme\EventStore\Types\EventHeader;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventPayload;
use hollodotme\EventStore\Types\OccurredOn;
use hollodotme\EventStore\Types\ServerId;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Domain\EventEnvelope;

/**
 * Class EventEnvelopeBuilder
 * @package hollodotme\IdentityAndAccess\Domain\Services
 */
final class EventEnvelopeBuilder implements BuildsEventEnvelope
{
	/** @var MapsEvent */
	private $eventMapper;

	public function __construct()
	{
		$this->eventMapper = new EventMapper();
	}

	public function fromEvent(
		StreamName $streamName, StreamSequence $streamSequence, ImpliesChange $event
	) : EnclosesEvent
	{
		$header = new EventHeader(
			$streamName,
			$event->getStreamId(),
			$streamSequence,
			new OccurredOn( new \DateTimeImmutable() ),
			new ActorName( $_SERVER['USER'] ? : '' ),
			new ServerId( $_SERVER['SERVER_ADDR'] )
		);

		return new EventEnvelope( $header, $event );
	}

	public function fromRecord( array $record ) : EnclosesEvent
	{
		$header = new EventHeader(
			new StreamName( $record['streamName'] ),
			new StreamId( $record['streamId'] ),
			new StreamSequence( $record['streamSequence'] ),
			OccurredOn::fromDateTimeString( $record['occurredOn'] ),
			new ActorName( $record['actorName'] ),
			new ServerId( $record['serverId'] )
		);

		$envelope = new EventEnvelope(
			$header,
			$this->eventMapper->mapEvent(
				$header,
				new EventId( $record['eventId'] ),
				EventPayload::fromString( $record['eventPayload'] )
			)
		);

		return $envelope;
	}
}