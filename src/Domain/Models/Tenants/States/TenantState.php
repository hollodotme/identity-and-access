<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\States;

/**
 * Class TenantState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\States
 */
abstract class TenantState
{
	const BLOCKED   = 'blocked';

	const UNBLOCKED = 'unblocked';
}