<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class ServerId
 * @package hollodotme\EventStore
 */
final class ServerId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $serverId;

	public function __construct( string $serverId )
	{
		$this->serverId = $serverId;
	}

	public function toString() : string
	{
		return $this->serverId;
	}
}