<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Types;

use hollodotme\PubSub\Interfaces\RepresentsValueAsString;
use hollodotme\PubSub\Traits\Scalarizing;

/**
 * Class MessageName
 * @package hollodotme\PubSub\Types
 */
final class MessageName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $messageName;

	public function __construct( string $messageName )
	{
		$this->messageName = $messageName;
	}

	public function toString() : string
	{
		return $this->messageName;
	}

	public function equalsString( string $other ) : bool
	{
		return ($other == $this->toString());
	}
}