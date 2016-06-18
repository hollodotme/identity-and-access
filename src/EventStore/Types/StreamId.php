<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class StreamId
 * @package hollodotme\EventStore\Types
 */
final class StreamId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $streamId;

	public function __construct( string $streamId )
	{
		$this->streamId = $streamId;
	}

	public function toString() : string
	{
		return $this->streamId;
	}
}