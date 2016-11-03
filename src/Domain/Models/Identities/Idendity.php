<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Identities;

use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\Events\RoleWasAssigned;
use hollodotme\IdentityAndAccess\Domain\Models\Roles\Exceptions\RoleAlreadyAssigned;
use hollodotme\IdentityAndAccess\Domain\Models\Roles\Role;

/**
 * Class Idendity
 * @package hollodotme\IdentityAndAccess\Domain\Models\Identities
 */
final class Idendity extends AbstractAggregateRoot
{
	/** @var IdentityId */
	private $id;

	/** @var IdentityEmail */
	private $email;

	/** @var IdentityName */
	private $name;

	/** @var array|Role[] */
	private $roles;

	public static function register( IdentityId $id, IdentityEmail $email, IdentityName $name ) : self
	{
		$identity = new self();
		$identity->trackThat( new IdentityWasRegistered( $id, $email, $name ) );

		return $identity;
	}

	protected function whenIdentityWasRegistered( IdentityWasRegistered $event )
	{
		$this->id    = $event->getIdidentityId();
		$this->email = $event->getIdentityEmail();
		$this->name  = $event->getIdentityName();
		$this->roles = [];
	}

	public function assignRole( Role $role )
	{
		if ( !$this->hasRole( $role ) )
		{
			$this->trackThat( new RoleWasAssigned( $this->id, $role ) );
		}
		else
		{
			throw (new RoleAlreadyAssigned())->withIdentityIdAndRole( $this->id, $role );
		}
	}

	private function hasRole( Role $other ) : bool
	{
		foreach ( $this->roles as $role )
		{
			if ( $role->equals( $other ) )
			{
				return true;
			}
		}

		return false;
	}

	protected function whenRoleWasAssigned( RoleWasAssigned $event )
	{
		$this->roles[] = $event->getRole();
	}
}
