<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsIdentityState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces
 */
interface RepresentsIdentityState extends RepresentsValueAsString
{
	public function block(): RepresentsIdentityState;

	public function unblock(): RepresentsIdentityState;

	public function canBlock(): bool;

	public function canUnblock(): bool;
}
