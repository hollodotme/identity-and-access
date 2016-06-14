<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;

/**
 * Interface RepresentsTenantState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces
 */
interface RepresentsTenantState extends RepresentsValueAsString
{
	public function block() : RepresentsTenantState;

	public function unblock() : RepresentsTenantState;
}