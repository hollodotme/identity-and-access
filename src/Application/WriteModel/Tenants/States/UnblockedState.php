<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class UnblockedState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States
 */
final class UnblockedState extends AbstractTenantState
{
	public function block() : RepresentsTenantState
	{
		return new BlockedState();
	}

	public function canBlock() : bool
	{
		return true;
	}

	public function toString() : string
	{
		return TenantState::UNBLOCKED;
	}
}
