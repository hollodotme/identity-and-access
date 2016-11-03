<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions;

use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class IllegalTenantState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions
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
