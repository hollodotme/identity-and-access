<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants;

use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions\IllegalTenantStateTransition;
use Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractTenantState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants
 */
abstract class AbstractTenantState implements RepresentsTenantState
{
	use Scalarizing;

	public function block() : RepresentsTenantState
	{
		throw new IllegalTenantStateTransition();
	}

	public function unblock() : RepresentsTenantState
	{
		throw new IllegalTenantStateTransition();
	}
}