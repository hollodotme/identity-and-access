<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users\States;

use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Exceptions\IllegalUserStateTransition;
use Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractUserState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users\States
 */
abstract class AbstractUserState implements RepresentsUserState
{
	use Scalarizing;

	public function block() : RepresentsUserState
	{
		throw new IllegalUserStateTransition();
	}

	public function unblock() : RepresentsUserState
	{
		throw new IllegalUserStateTransition();
	}
}