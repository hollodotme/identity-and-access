<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class BlockedState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States
 */
final class BlockedState extends AbstractTenantState
{
	public function unblock() : RepresentsTenantState
	{
		return new UnblockedState();
	}

	public function canUnblock() : bool
	{
		return true;
	}

	public function toString() : string
	{
		return TenantState::BLOCKED;
	}
}
