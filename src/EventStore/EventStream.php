<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\EnclosesEvent;

/**
 * Class EventStream
 * @package hollodotme\EventStore
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
	 * @return array|Interfaces\EnclosesEvent[]
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