<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsUserState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces
 */
interface RepresentsUserState extends RepresentsValueAsString
{
	public function block() : RepresentsUserState;

	public function unblock() : RepresentsUserState;

	public function canBlock() : bool;

	public function canUnblock() : bool;
}