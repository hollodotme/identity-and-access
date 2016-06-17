<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class ActorName
 * @package hollodotme\EventStore
 */
final class ActorName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $actorName;

	public function __construct( string $actorName )
	{
		$this->actorName = $actorName;
	}

	public function toString() : string
	{
		return $this->actorName;
	}
}