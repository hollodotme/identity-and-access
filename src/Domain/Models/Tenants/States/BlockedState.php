<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\States;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\AbstractTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class BlockedState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\States
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
