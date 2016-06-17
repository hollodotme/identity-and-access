<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UserName
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users
 */
final class UserName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $userName;

	public function __construct( string $userName )
	{
		$this->userName = $userName;
	}

	public function toString() : string
	{
		return $this->userName;
	}
}