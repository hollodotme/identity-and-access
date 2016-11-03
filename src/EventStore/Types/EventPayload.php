<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class EventPayload
 * @package hollodotme\EventStore\Types
 */
final class EventPayload implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var array */
	private $eventPayload;

	public function __construct( array $eventPayload )
	{
		$this->eventPayload = $eventPayload;
	}

	public function toString() : string
	{
		return json_encode( $this->eventPayload );
	}

	public function jsonSerialize()
	{
		return $this->eventPayload;
	}

	public function toArray() : array
	{
		return $this->eventPayload;
	}

	public static function fromString( string $string ) : self
	{
		$eventPayload = json_decode( $string, true );

		return new self( $eventPayload );
	}
}
