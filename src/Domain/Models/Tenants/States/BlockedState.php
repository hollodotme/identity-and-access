<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States;

use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\AbstractTenantState;
use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class BlockedState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States
 */
final class BlockedState extends AbstractTenantState
{
	public function unblock() : RepresentsTenantState
	{
		return new UnblockedState();
	}

	public function toString() : string
	{
		return TenantState::BLOCKED;
	}
}