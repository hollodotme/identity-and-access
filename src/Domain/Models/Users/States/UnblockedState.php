<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States;

use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;

/**
 * Class UnblockedState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States
 */
final class UnblockedState extends AbstractUserState
{
	public function block() : RepresentsUserState
	{
		return new BlockedState();
	}

	public function toString() : string
	{
		return UserState::UNBLOCKED;
	}
}