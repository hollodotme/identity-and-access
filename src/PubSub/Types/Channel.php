<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Types;

use hollodotme\PubSub\Interfaces\RepresentsValueAsString;
use hollodotme\PubSub\Traits\Scalarizing;

/**
 * Class Channel
 * @package hollodotme\PubSub\Types
 */
final class Channel implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $channel;

	public function __construct( string $channel )
	{
		$this->channel = $channel;
	}

	public function toString() : string
	{
		return $this->channel;
	}

	public function equalsString( string $other ) : bool
	{
		return ($other == $this->toString());
	}
}