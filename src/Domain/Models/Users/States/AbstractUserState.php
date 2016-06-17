<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States;

use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Exceptions\IllegalUserStateTransition;
use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class AbstractUserState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States
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