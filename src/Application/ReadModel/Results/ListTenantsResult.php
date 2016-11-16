<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Results;

use hollodotme\IdentityAndAccess\Application\ReadModel\Tenants\Tenant;

/**
 * Class ListTenantsResult
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Results
 */
final class ListTenantsResult extends AbstractResult
{
	/** @var array|Tenant[] */
	private $tenants;

	public function getTenants() : array
	{
		return $this->tenants;
	}

	public function setTenants( array $tenants )
	{
		$this->tenants = $tenants;
	}
}
