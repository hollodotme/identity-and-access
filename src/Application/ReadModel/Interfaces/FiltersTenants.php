<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces;

use hollodotme\IdentityAndAccess\Application\ReadModel\Tenants\Tenant;

/**
 * Interface FiltersTenants
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces
 */
interface FiltersTenants
{
	public function isValid( Tenant $tenant ): bool;
}
