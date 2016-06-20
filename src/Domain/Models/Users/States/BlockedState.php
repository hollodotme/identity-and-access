<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States;

use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;

/**
 * Class BlockedState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States
 */
final class BlockedState extends AbstractUserState
{
	public function unblock() : RepresentsUserState
	{
		return new UnblockedState();
	}

	public function canUnblock() : bool
	{
		return true;
	}

	public function toString() : string
	{
		return UserState::BLOCKED;
	}
}