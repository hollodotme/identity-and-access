<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

/**
 * Class EventHeader
 * @package hollodotme\EventStore
 */
final class EventHeader
{
	/** @var StreamName */
	private $streamName;

	/** @var StreamId */
	private $streamId;

	/** @var StreamSequence */
	private $streamSequence;

	/** @var OccurredOn */
	private $occurredOn;

	/** @var ActorName */
	private $actorName;

	/** @var ServerId */
	private $serverId;

	public function __construct(
		StreamName $streamName, StreamId $streamId, StreamSequence $streamSequence,
		OccurredOn $occurredOn, ActorName $actorName, ServerId $serverId
	)
	{
		$this->streamName     = $streamName;
		$this->streamId       = $streamId;
		$this->streamSequence = $streamSequence;
		$this->occurredOn     = $occurredOn;
		$this->actorName      = $actorName;
		$this->serverId       = $serverId;
	}

	public function getStreamName() : StreamName
	{
		return $this->streamName;
	}

	public function getStreamId() : StreamId
	{
		return $this->streamId;
	}

	public function getStreamSequence() : StreamSequence
	{
		return $this->streamSequence;
	}

	public function getOccurredOn() : OccurredOn
	{
		return $this->occurredOn;
	}

	public function getActorName() : ActorName
	{
		return $this->actorName;
	}

	public function getServerId() : ServerId
	{
		return $this->serverId;
	}
}