<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsTenantState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces
 */
interface RepresentsTenantState extends RepresentsValueAsString
{
	public function block() : RepresentsTenantState;

	public function unblock() : RepresentsTenantState;
}