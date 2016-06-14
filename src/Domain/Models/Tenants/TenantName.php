<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class TenantName
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants
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