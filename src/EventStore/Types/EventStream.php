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
	/** @var array|EnclosesEvent[] */
	private $eventEnvelopes;

	public function __construct()
	{
		$this->flush();
	}

	public function addEventEnvelope( EnclosesEvent $eventEnvelope )
	{
		$this->eventEnvelopes[] = $eventEnvelope;
	}

	/**
	 * @return array|EnclosesEvent[]
	 */
	public function getEventEnvelopes() : array
	{
		return $this->eventEnvelopes;
	}

	public function isEmpty() : bool
	{
		return empty($this->eventEnvelopes);
	}

	public function flush()
	{
		$this->eventEnvelopes = [ ];
	}
}
