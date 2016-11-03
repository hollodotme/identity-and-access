<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Roles\Exceptions;

use hollodotme\IdentityAndAccess\Domain\Exceptions\DomainException;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Domain\Models\Roles\Role;

/**
 * Class RoleAlreadyAssigned
 * @package hollodotme\IdentityAndAccess\Domain\Models\Roles\Exceptions
 */
final class RoleAlreadyAssigned extends DomainException
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
