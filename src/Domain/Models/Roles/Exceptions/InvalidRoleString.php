<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Roles\Exceptions;

use hollodotme\IdentityAndAccess\Domain\Exceptions\DomainException;

/**
 * Class InvalidRoleString
 * @package hollodotme\IdentityAndAccess\Domain\Models\Roles\Exceptions
 */
final class InvalidRoleString extends DomainException
{
	/** @var string */
	private $roleString;

	public function getRoleString(): string
	{
		return $this->roleString;
	}

	public function withRoleString( string $roleString ): InvalidRoleString
	{
		$this->roleString = $roleString;

		return $this;
	}
}
