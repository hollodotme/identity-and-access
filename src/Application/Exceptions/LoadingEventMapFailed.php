<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Exceptions;

use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class LoadingEventMapFailed
 * @package hollodotme\IdentityAndAccess\Application\Exceptions
 */
final class LoadingEventMapFailed extends IdentityAndAccessException
{
	/** @var StreamName */
	private $streamName;

	/** @var string */
	private $eventId;

	public function getStreamName(): StreamName
	{
		return $this->streamName;
	}

	public function getEventId(): string
	{
		return $this->eventId;
	}

	public function withStreamNameAndEventId( StreamName $streamName, EventId $eventId ): self
	{
		$this->streamName = $streamName;
		$this->eventId = $eventId;

		return $this;
	}
}
