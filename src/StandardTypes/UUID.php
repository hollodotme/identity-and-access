<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\StandardTypes;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UUID
 * @package Dreiwolt\IdentityAndAccess\StandardTypes
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