<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class EventId
 * @package hollodotme\EventStore
 */
final class EventId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $eventId;

	public function __construct( string $eventId )
	{
		$this->eventId = $eventId;
	}

	public function toString() : string
	{
		return $this->eventId;
	}

	public static function fromEventClassName( string $className ) : self
	{
		$nsParts   = explode( '\\', $className );
		$className = end( $nsParts );

		return new self( $className );
	}
}