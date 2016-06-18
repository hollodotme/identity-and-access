<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Adapters\MySql;

use hollodotme\EventStore\Adapters\MySql\Exceptions\MySqlException;
use hollodotme\EventStore\EventEnvelope;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\MapsEvent;
use hollodotme\EventStore\Interfaces\StoresEventStream;
use hollodotme\EventStore\Types\ActorName;
use hollodotme\EventStore\Types\EventHeader;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\EventPayload;
use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\OccurredOn;
use hollodotme\EventStore\Types\ServerId;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;

/**
 * Class EventStore
 * @package hollodotme\EventStore\Adapters\MySql
 */
final class MySqlAdapter implements StoresEventStream
{
	/** @var MySqlConnection */
	private $connection;

	/** @var MySqlManager */
	private $manager;

	public function __construct( MySqlConnection $connection )
	{
		$this->connection = $connection;
	}

	/**
	 * @param EventStream $eventStream
	 *
	 * @throws MySqlException
	 */
	public function persistEventStream( EventStream $eventStream )
	{
		$this->getManager()->beginTransaction();

		try
		{
			$statement = $this->getManager()->prepare(
				"INSERT INTO `EventStore` (streamName, streamId, streamSequence, eventId, eventName, eventPayload, occurredOn, actorName, serverId)
				 VALUES (:streamName, :streamId, :streamSequence, :eventId, :eventName, :eventPayload, :occurredOn, :actorName, :serverId)"
			);

			foreach ( $eventStream->getEventEnvelopes() as $eventEnvelope )
			{
				$this->persistEventEnvelope( $statement, $eventEnvelope );
			}

			$this->getManager()->commit();
		}
		catch ( MySqlException $e )
		{
			$this->getManager()->rollBack();

			throw $e;
		}
		catch ( \Throwable $e )
		{
			$this->getManager()->rollBack();

			throw new MySqlException( $e->getMessage(), $e->getCode(), $e );
		}
	}

	private function getManager() : MySqlManager
	{
		if ( $this->manager === null )
		{
			$this->manager = new MySqlManager( $this->connection );
		}

		return $this->manager;
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

		$statement = $this->getManager()->prepare( $query );
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