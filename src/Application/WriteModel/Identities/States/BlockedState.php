<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;

/**
 * Class BlockedState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States
 */
final class BlockedState extends AbstractIdentityState
{
	public function unblock(): RepresentsIdentityState
	{
		return new UnblockedState();
	}

	public function canBlock(): bool
	{
		return true;
	}

	public function toString(): string
	{
		return IdentityState::BLOCKED;
	}
}
