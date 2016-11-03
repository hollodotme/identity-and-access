<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions;

use hollodotme\IdentityAndAccess\Application\Exceptions\ApplicationException;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Role;

/**
 * Class RoleAlreadyAssigned
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions
 */
final class RoleAlreadyAssigned extends ApplicationException
{
	/** @var IdentityId */
	private $identityId;

	/** @var Role */
	private $role;

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function getRole(): Role
	{
		return $this->role;
	}

	public function withIdentityIdAndRole( IdentityId $identityId, Role $role ): RoleAlreadyAssigned
	{
		$this->identityId = $identityId;
		$this->role       = $role;

		return $this;
	}
}
