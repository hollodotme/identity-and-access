<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasUnblocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\RoleWasAssigned;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\UnblockedState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Exceptions\RoleAlreadyAssigned;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Role;

/**
 * Class Identity
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class Identity extends AbstractAggregateRoot
{
	/** @var IdentityId */
	private $id;

	/** @var IdentityEmail */
	private $email;

	/** @var IdentityPasswordHash */
	private $passwordHash;

	/** @var IdentityName */
	private $name;

	/** @var RepresentsIdentityState */
	private $state;

	/** @var array|Role[] */
	private $roles;

	/** @var array|IdentityProperty[] */
	private $properties;

	public static function register(
		IdentityId $id,
		IdentityEmail $email,
		IdentityPasswordHash $passwordHash,
		IdentityName $name
	): self
	{
		$identity = new self();
		$identity->trackThat( new IdentityWasRegistered( $id, $email, $passwordHash, $name, new UnblockedState() ) );

		return $identity;
	}

	protected function whenIdentityWasRegistered( IdentityWasRegistered $event )
	{
		$this->id           = $event->getIdentityId();
		$this->email        = $event->getIdentityEmail();
		$this->passwordHash = $event->getIdentityPasswordHash();
		$this->name         = $event->getIdentityName();

		$this->setState( $event->getIdentityState() );

		$this->roles      = [];
		$this->properties = [];
	}

	private function setState( RepresentsIdentityState $identityState )
	{
		$this->state = $identityState;
	}

	public function block()
	{
		$this->trackThat( new IdentityWasBlocked( $this->id, $this->state->block() ) );
	}

	protected function whenIdentityWasBlocked( IdentityWasBlocked $event )
	{
		$this->setState( $event->getIdentityState() );
	}

	public function unblock()
	{
		$this->trackThat( new IdentityWasBlocked( $this->id, $this->state->unblock() ) );
	}

	protected function whenIdentityWasUnblocked( IdentityWasUnblocked $event )
	{
		$this->setState( $event->getIdentityState() );
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

	private function hasRole( Role $other ): bool
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
