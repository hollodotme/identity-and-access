<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class StreamSequence
 * @package hollodotme\EventStore\Types
 */
final class StreamSequence implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var int */
	private $streamSequence;

	public function __construct( int $streamSequence )
	{
		$this->streamSequence = $streamSequence;
	}

	public function toString() : string
	{
		return (string)$this->streamSequence;
	}

	public function increment() : self
	{
		return new self( $this->streamSequence + 1 );
	}
}
