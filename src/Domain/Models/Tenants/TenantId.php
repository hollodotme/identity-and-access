<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class TenantId
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants
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