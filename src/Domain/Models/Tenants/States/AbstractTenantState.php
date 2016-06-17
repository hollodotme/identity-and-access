<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions\IllegalTenantStateTransition;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractTenantState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants
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