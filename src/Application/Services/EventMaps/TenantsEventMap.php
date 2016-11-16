<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services\EventMaps;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasUnblocked;

/**
 * Class TenantsEventMap
 * @package hollodotme\IdentityAndAccess\Application\Services\EventMaps
 */
final class TenantsEventMap extends AbstractEventMap
{
	const MAP = [
		'TenantWasRegistered' => TenantWasRegistered::class,
		'TenantWasBlocked'    => TenantWasBlocked::class,
		'TenantWasUnblocked'  => TenantWasUnblocked::class,
	];
}
