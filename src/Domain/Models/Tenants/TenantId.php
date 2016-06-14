<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Tenants;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\StandardTypes\UUID;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class TenantId
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Tenants
 */
final class TenantId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var UUID */
	private $tenantId;

	public function __construct( UUID $tenantId )
	{
		$this->tenantId = $tenantId;
	}

	public function toString() : string
	{
		return $this->tenantId->toString();
	}
}