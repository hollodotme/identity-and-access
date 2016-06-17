<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States;

/**
 * Class UserState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States
 */
abstract class UserState
{
	const BLOCKED   = 'blocked';

	const UNBLOCKED = 'unblocked';
}