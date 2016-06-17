<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Adapters\MySql;

use hollodotme\EventStore\ActorName;
use hollodotme\EventStore\Adapters\MySql\Exceptions\MySqlException;
use hollodotme\EventStore\EventEnvelope;
use hollodotme\EventStore\EventHeader;
use hollodotme\EventStore\EventId;
use hollodotme\EventStore\EventPayload;
use hollodotme\EventStore\EventStream;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\MapsEvent;
use hollodotme\EventStore\Interfaces\PersistsEventStream;
use hollodotme\EventStore\Interfaces\RetrievesEventStream;
use hollodotme\EventStore\OccurredOn;
use hollodotme\EventStore\ServerId;
use hollodotme\EventStore\StreamId;
use hollodotme\EventStore\StreamName;
use hollodotme\EventStore\StreamSequence;

/**
 * Class EventStore
 * @package hollodotme\EventStore\Adapters\MySql
 */
final class MySqlEventStore implements PersistsEventStream, RetrievesEventStream
{
	/** @var MySqlManager */
	private $manager;

	public function __construct( MySqlManager $manager )
	{
		$this->manager = $manager;
	}

	/**
	 * @param EventStream $eventStream
	 *
	 * @throws MySqlException
	 */
	public function persistEventStream( EventStream $eventStream )
	{
		$this->manager->beginTransaction();

		try
		{
			$statement = $this->manager->prepare(
				"INSERT INTO `EventStore` (streamName, streamId, streamSequence, eventId, eventName, eventPayload, occurredOn, actorName, serverId)
				 VALUES (:streamName, :streamId, :streamSequence, :eventId, :eventName, :eventPayload, :occurredOn, :actorName, :serverId)"
			);

			foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
			{
				$this->persistEventEnvelope( $statement, $eventEnvelope );
			}

			$this->manager->commit();
		}
		catch ( MySqlException $e )
		{
			$this->manager->rollBack();

			throw $e;
		}
		catch ( \Throwable $e )
		{
			$this->manager->rollBack();

			throw new MySqlException( $e->getMessage(), $e->getCode(), $e );
		}
	}

	/**
	 * @param \PDOStatement $statement
	 * @param EnclosesEvent $eventEnvelope
	 *
	 * @throws MySqlException
	 */
	private function persistEventEnvelope( \PDOStatement $statement, EnclosesEvent $eventEnvelope )
	{
		$header = $eventEnvelope->getHeader();
		$event  = $eventEnvelope->getEvent();

		$result = $statement->execute(
			[
				'streamName'     => $header->getStreamName()->toString(),
				'streamId'       => $header->getStreamId()->toString(),
				'streamSequence' => $header->getStreamSequence()->toString(),
				'eventId'        => $event->getId()->toString(),
				'eventName'      => $event->getName()->toString(),
				'eventPayload'   => $event->getPayload()->toString(),
				'occurredOn'     => $header->getOccurredOn()->toString(),
				'actorName'      => $header->getActorName()->toString(),
				'serverId'       => $header->getServerId()->toString(),
			]
		);

		if ( !$result )
		{
			$errorInfo    = $statement->errorInfo();
			$errorMessage = $errorInfo[1] . ': ' . $errorInfo[2];

			throw new MySqlException( 'Execution of prepared statement failed. ' . $errorMessage );
		}

		$this->guardStatementExecutionSucceeded( $statement );
	}

	/**
	 * @param \PDOStatement $statement
	 *
	 * @throws MySqlException
	 */
	private function guardStatementExecutionSucceeded( \PDOStatement $statement )
	{
		if ( $statement->errorCode() > 0 )
		{
			$errorInfo    = $statement->errorInfo();
			$errorMessage = $errorInfo[1] . ': ' . $errorInfo[2];

			throw new MySqlException( $errorMessage, $errorInfo[0] );
		}
	}

	public function retrieveEventStream(
		StreamName $streamName, StreamId $streamId, MapsEvent $eventMapper
	) : EventStream
	{
		$query = "SELECT streamName, streamId, streamSequence, eventId, eventName, eventPayload, occurredOn, actorName, serverId 
				  FROM `EventStore`
				  WHERE streamName = :streamName
				    AND streamId = :streamId
				  ORDER BY streamSequence ASC";

		$statement = $this->manager->prepare( $query );
		$statement->execute(
			[
				'streamName' => $streamName->toString(),
				'streamId'   => $streamId->toString(),
			]
		);

		$eventStream = new EventStream();

		foreach ( $this->fetchEventEnvelopes( $statement, $eventMapper ) as $eventEnvelope )
		{
			$eventStream->addEventEnvelope( $eventEnvelope );
		}

		return $eventStream;
	}

	private function fetchEventEnvelopes( \PDOStatement $statement, MapsEvent $eventMapper ) : \Generator
	{
		while ( $record = $statement->fetchObject() )
		{
			$header = new EventHeader(
				new StreamName( $record->streamName ),
				new StreamId( $record->streamId ),
				new StreamSequence( $record->streamSequence ),
				OccurredOn::fromDateTimeString( $record->occurredOn ),
				new ActorName( $record->actorName ),
				new ServerId( $record->serverId )
			);

			yield new EventEnvelope(
				$header,
				$eventMapper->mapEvent(
					$header,
					new EventId( $record->eventId ),
					EventPayload::fromString( $record->eventPayload )
				)
			);
		}
	}
}