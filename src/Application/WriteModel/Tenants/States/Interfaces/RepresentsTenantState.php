<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsTenantState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces
 */
interface RepresentsTenantState extends RepresentsValueAsString
{
	public function block() : RepresentsTenantState;

	public function unblock() : RepresentsTenantState;

	public function canBlock() : bool;

	public function canUnblock() : bool;
}
