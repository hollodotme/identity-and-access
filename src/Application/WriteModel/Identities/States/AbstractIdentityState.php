<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Exceptions\IllegaldentityState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Exceptions\IllegalIdentityStateTransition;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractIdentityState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States
 */
abstract class AbstractIdentityState implements RepresentsIdentityState
{
	use Scalarizing;

	public function block(): RepresentsIdentityState
	{
		throw new IllegalIdentityStateTransition();
	}

	public function unblock(): RepresentsIdentityState
	{
		throw new IllegalIdentityStateTransition();
	}

	public function canBlock(): bool
	{
		return false;
	}

	public function canUnblock(): bool
	{
		return false;
	}

	public static function fromString( string $stateName ): RepresentsIdentityState
	{
		switch ( $stateName )
		{
			case IdentityState::BLOCKED:
				return new BlockedState();

			case IdentityState::UNBLOCKED:
				return new UnblockedState();
		}

		throw (new IllegaldentityState())->withStateName( $stateName );
	}
}
