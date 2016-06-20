<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users;

use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Domain\Models\Roles\Role;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Domain\Models\Users\Events\UserWasInstalled;
use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;
use hollodotme\IdentityAndAccess\Domain\Models\Users\States\UnblockedState;

/**
 * Class User
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users
 */
final class User extends AbstractAggregateRoot
{
	/** @var TenantId */
	private $tenantId;

	/** @var UserId */
	private $id;

	/** @var UserName */
	private $name;

	/** @var RepresentsUserState */
	private $state;

	/** @var array|Role[] */
	private $roles;

	public static function install( TenantId $tenantId, UserId $id, UserName $name ) : self
	{
		$user = new self();
		$user->trackThat( new UserWasInstalled( $tenantId, $id, $name, new UnblockedState() ) );

		return $user;
	}

	protected function whenUserWasInstalled( UserWasInstalled $event )
	{
		$this->tenantId = $event->getTenantId();
		$this->id       = $event->getId();
		$this->name     = $event->getName();
		$this->setState( $event->getState() );
	}

	private function setState( RepresentsUserState $state )
	{
		$this->state = $state;
	}

	public function assignRole( Role $role )
	{
		if ( !$this->hasRole( $role ) )
		{
			$this->roles[] = $role;
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

		return true;
	}

	public function block()
	{
		$this->setState( $this->state->block() );
	}

	public function unblock()
	{
		$this->setState( $this->state->unblock() );
	}

	/**
	 * @return TenantId
	 */
	public function getTenantId()
	{
		return $this->tenantId;
	}

	/**
	 * @return UserId
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return UserName
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return RepresentsUserState
	 */
	public function getState()
	{
		return $this->state;
	}
}