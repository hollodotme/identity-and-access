<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions;

use hollodotme\IdentityAndAccess\Application\Exceptions\ApplicationException;

/**
 * Class InvalidRoleString
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions
 */
final class InvalidRoleString extends ApplicationException
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
