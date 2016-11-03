<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States;

/**
 * Class TenantState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States
 */
abstract class TenantState
{
	const BLOCKED   = 'blocked';

	const UNBLOCKED = 'unblocked';
}
