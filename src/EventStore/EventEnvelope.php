<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\CarriesEventData;
use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Types\EventHeader;

/**
 * Class EventEnvelope
 * @package hollodotme\EventStore
 */
final class EventEnvelope implements EnclosesEvent
{
	/** @var EventHeader */
	private $header;

	/** @var CarriesEventData */
	private $event;

	/**
	 * @param EventHeader      $header
	 * @param CarriesEventData $event
	 */
	public function __construct( EventHeader $header, CarriesEventData $event )
	{
		$this->header = $header;
		$this->event  = $event;
	}

	public function getHeader() : EventHeader
	{
		return $this->header;
	}

	public function getEvent() : CarriesEventData
	{
		return $this->event;
	}
}