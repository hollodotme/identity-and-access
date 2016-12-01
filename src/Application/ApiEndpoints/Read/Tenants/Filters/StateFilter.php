<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants\Filters;

use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersTenants;
use hollodotme\IdentityAndAccess\Application\ReadModel\Tenants\Tenant;

/**
 * Class StateFilter
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants\Filters
 */
final class StateFilter implements FiltersTenants
{
	/** @var array */
	private $states;

	public function __construct( array $states )
	{
		$this->states = $states;
	}

	public function isValid( Tenant $tenant ): bool
	{
		return in_array( $tenant->getState(), $this->states );
	}
}
