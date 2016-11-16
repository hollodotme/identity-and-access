<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Queries;

/**
 * Class ListTenantsQuery
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Queries
 */
final class ListTenantsQuery
{
	/** @var array */
	private $tenantStatus;

	public function __construct( array $tenantStatus )
	{
		$this->tenantStatus = $tenantStatus;
	}

	public function getTenantStates(): array
	{
		return $this->tenantStatus;
	}
}
