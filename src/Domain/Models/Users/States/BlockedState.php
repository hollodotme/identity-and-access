<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users\States;

use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;

/**
 * Class BlockedState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users\States
 */
final class BlockedState extends AbstractUserState
{
	public function unblock() : RepresentsUserState
	{
		return new UnblockedState();
	}

	public function toString() : string
	{
		return UserState::BLOCKED;
	}
}