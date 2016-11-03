<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class EventName
 * @package hollodotme\EventStore\Types
 */
final class EventName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $eventName;

	public function __construct( string $eventName )
	{
		$this->eventName = $eventName;
	}

	public function toString() : string
	{
		return $this->eventName;
	}

	public static function fromEventClassName( string $className ) : self
	{
		$nsParts   = explode( '\\', $className );
		$className = end( $nsParts );

		$eventName = preg_replace(
			[ '#([A-Z]+)#', '# ([A-Z]+)([A-Z][a-z])#' ],
			[ ' $1', ' $1 $2' ],
			$className
		);

		return new self( $eventName );
	}
}
