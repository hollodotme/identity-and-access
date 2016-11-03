<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Services\EventMaps;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\Events\TenantWasRegistered;

/**
 * Class TenantsEventMap
 * @package hollodotme\IdentityAndAccess\Domain\Services\EventMaps
 */
final class TenantsEventMap extends AbstractEventMap
{
	const MAP = [
		'TenantWasRegistered' => TenantWasRegistered::class,
	];
}
