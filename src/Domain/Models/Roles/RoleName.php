<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Roles;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class RoleName
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Roles
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