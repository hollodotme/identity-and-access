<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsUserState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users\States\Interfaces
 */
interface RepresentsUserState extends RepresentsValueAsString
{
	public function block() : RepresentsUserState;

	public function unblock() : RepresentsUserState;
}