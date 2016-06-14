<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Roles;

use Dreiwolt\IdentityAndAccess\Domain\Models\Applications\ApplicationId;

/**
 * Class Role
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Roles
 */
final class Role
{
	/** @var ApplicationId */
	private $applicationId;

	/** @var RoleName */
	private $name;

	public function __construct( ApplicationId $applicationId, RoleName $name )
	{
		$this->applicationId = $applicationId;
		$this->name          = $name;
	}

	public function getApplicationId() : ApplicationId
	{
		return $this->applicationId;
	}

	public function getName() : RoleName
	{
		return $this->name;
	}

	public function equals( Role $other ) : bool
	{
		if ( $this->applicationId != $other->getApplicationId() )
		{
			return false;
		}

		if ( $this->name != $other->getName() )
		{
			return false;
		}

		return true;
	}
}