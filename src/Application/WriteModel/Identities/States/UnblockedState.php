<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;

/**
 * Class UnblockedState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States
 */
final class UnblockedState extends AbstractIdentityState
{
	public function block(): RepresentsIdentityState
	{
		return new BlockedState();
	}

	public function canUnblock(): bool
	{
		return true;
	}

	public function toString(): string
	{
		return IdentityState::UNBLOCKED;
	}
}
