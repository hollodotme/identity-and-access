<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\States;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\AbstractTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class UnblockedState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\States
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
