<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\StandardTypes;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UUID
 * @package hollodotme\IdentityAndAccess\StandardTypes
 */
final class UUID implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $UUIDString;

	public function __construct( string $UUIDString )
	{
		$this->UUIDString = $UUIDString;
	}

	public function toString() : string
	{
		return $this->UUIDString;
	}
}