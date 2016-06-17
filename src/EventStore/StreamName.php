<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class StreamName
 * @package hollodotme\EventStore
 */
final class StreamName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $streamName;

	public function __construct( string $streamName )
	{
		$this->streamName = $streamName;
	}

	public function toString() : string
	{
		return $this->streamName;
	}
}