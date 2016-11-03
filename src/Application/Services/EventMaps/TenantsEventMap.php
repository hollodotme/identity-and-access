<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services\EventMaps;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;

/**
 * Class TenantsEventMap
 * @package hollodotme\IdentityAndAccess\Application\Services\EventMaps
 */
final class TenantsEventMap extends AbstractEventMap
{
	const MAP = [
		'TenantWasRegistered' => TenantWasRegistered::class,
	];
}
