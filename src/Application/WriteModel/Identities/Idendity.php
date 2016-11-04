<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\RoleWasAssigned;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions\RoleAlreadyAssigned;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Role;

/**
 * Class Idendity
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class Idendity extends AbstractAggregateRoot
{
	/** @var IdentityId */
	private $id;

	/** @var IdentityEmail */
	private $email;

	/** @var IdentityPasswordHash */
	private $passwordHash;

	/** @var IdentityName */
	private $name;

	/** @var array|Role[] */
	private $roles;

	/** @var array|IdentityProperty[] */
	private $properties;

	public static function register(
		IdentityId $id,
		IdentityEmail $email,
		IdentityPasswordHash $passwordHash,
		IdentityName $name
	) : self
	{
		$identity = new self();
		$identity->trackThat( new IdentityWasRegistered( $id, $email, $passwordHash, $name ) );

		return $identity;
	}

	protected function whenIdentityWasRegistered( IdentityWasRegistered $event )
	{
		$this->id           = $event->getIdidentityId();
		$this->email        = $event->getIdentityEmail();
		$this->passwordHash = $event->getIdentityPasswordHash();
		$this->name         = $event->getIdentityName();
		$this->roles        = [];
		$this->properties   = [];
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
