<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States;

/**
 * Class TenantState
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants\States
 */
abstract class TenantState
{
	const BLOCKED   = 'blocked';

	const UNBLOCKED = 'unblocked';
}