<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class TenantName
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants
 */
final class TenantName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $tenantName;

	public function __construct( string $tenantName )
	{
		$this->tenantName = $tenantName;
	}

	public function toString() : string
	{
		return $this->tenantName;
	}
}