<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\BlockedState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions\IllegalTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Exceptions\IllegalTenantStateTransition;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\TenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\UnblockedState;
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

	public function canBlock() : bool
	{
		return false;
	}

	public function canUnblock() : bool
	{
		return false;
	}

	public static function fromString( string $stateName ) : RepresentsTenantState
	{
		switch ( $stateName )
		{
			case TenantState::BLOCKED:
				return new BlockedState();

			case TenantState::UNBLOCKED:
				return new UnblockedState();
		}

		throw ( new IllegalTenantState() )->withStateName( $stateName );
	}
}
