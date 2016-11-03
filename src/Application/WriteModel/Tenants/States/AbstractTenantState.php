<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions\IllegalTenantState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions\IllegalTenantStateTransition;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractTenantState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States
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

		throw (new IllegalTenantState())->withStateName( $stateName );
	}
}
