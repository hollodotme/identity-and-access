<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users\States;

use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;

/**
 * Class UnblockedState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users\States
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