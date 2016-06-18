<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Exceptions;

use hollodotme\EventStore\EventId;
use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class LookingUpClassNameFailed
 * @package hollodotme\IdentityAndAccess\Application\Exceptions
 */
final class LookingUpClassNameFailed extends IdentityAndAccessException
{
	/** @var EventId */
	private $eventId;

	public function getEventId() : EventId
	{
		return $this->eventId;
	}

	public function withEventId( EventId $eventId ) : self
	{
		$this->eventId = $eventId;

		return $this;
	}
}