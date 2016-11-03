<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Roles;

use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions\InvalidRoleString;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class Role
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Roles
 */
final class Role implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var TenantId */
	private $tenantId;

	/** @var RoleName */
	private $roleName;

	/** @var ContextName */
	private $contextName;

	public function __construct( TenantId $tenantId, RoleName $roleName, ContextName $contextName )
	{
		$this->tenantId    = $tenantId;
		$this->roleName    = $roleName;
		$this->contextName = $contextName;
	}

	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}

	public function getRoleName(): RoleName
	{
		return $this->roleName;
	}

	public function getContextName(): ContextName
	{
		return $this->contextName;
	}

	public function equals( Role $other ) : bool
	{
		return $other->toString() == $this->toString();
	}

	public function toString() : string
	{
		return sprintf( 'TID:%s[RN:%s]CN:%s', $this->tenantId, $this->roleName, $this->contextName );
	}

	public static function fromString( string $roleString ) : self
	{
		$matches = [];

		if ( preg_match( "#^TID\:([^\[]+)\[RN\:([^\]]+)]CN\:(.+)$#", $roleString, $matches ) )
		{
			$role = new self(
				new TenantId( $matches[1] ),
				new RoleName( $matches[2] ),
				new ContextName( $matches[3] )
			);

			return $role;
		}

		throw (new InvalidRoleString())->withRoleString( $roleString );
	}
}
