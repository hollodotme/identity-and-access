<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Roles;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class RoleName
 * @package hollodotme\IdentityAndAccess\Domain\Models\Roles
 */
final class RoleName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $roleName;

	public function __construct( string $roleName )
	{
		$this->roleName = $roleName;
	}

	public function toString() : string
	{
		return $this->roleName;
	}
}