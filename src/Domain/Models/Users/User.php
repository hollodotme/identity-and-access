<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users;

use Dreiwolt\IdentityAndAccess\Domain\Models\Roles\Role;
use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;
use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\UnblockedState;

/**
 * Class User
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users
 */
final class User
{
	/** @var TenantId */
	private $tenantId;

	/** @var UserId */
	private $userId;

	/** @var UserName */
	private $name;

	/** @var RepresentsUserState */
	private $state;

	/** @var array|Role[] */
	private $roles;

	public function __construct( TenantId $tenantId, UserId $userId, UserName $name )
	{
		$this->tenantId = $tenantId;
		$this->userId   = $userId;
		$this->name     = $name;

		$this->setState( new UnblockedState() );
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
	public function getUserId()
	{
		return $this->userId;
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