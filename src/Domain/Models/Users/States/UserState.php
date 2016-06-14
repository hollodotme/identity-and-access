<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users\States;

/**
 * Class UserState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users\States
 */
abstract class UserState
{
	const BLOCKED   = 'blocked';

	const UNBLOCKED = 'unblocked';
}