<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States;

use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\AbstractTenantState;
use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;

/**
 * Class UnblockedState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States
 */
final class UnblockedState extends AbstractTenantState
{
	public function block() : RepresentsTenantState
	{
		return new BlockedState();
	}

	public function toString() : string
	{
		return TenantState::UNBLOCKED;
	}
}