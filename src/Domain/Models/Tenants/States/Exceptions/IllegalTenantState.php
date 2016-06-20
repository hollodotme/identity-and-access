<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions;

use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class IllegalTenantState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions
 */
final class IllegalTenantState extends IdentityAndAccessException
{
	/** @var string */
	private $stateName;

	public function getStateName() : string
	{
		return $this->stateName;
	}

	public function withStateName( string $stateName ) : self
	{
		$this->stateName = $stateName;

		return $this;
	}
}