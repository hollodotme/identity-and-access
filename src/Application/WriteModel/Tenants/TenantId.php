<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants;

use hollodotme\IdentityAndAccess\Application\Traits\UUIDGenerating;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class TenantId
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants
 */
final class TenantId implements RepresentsValueAsString
{
	use Scalarizing;
	use UUIDGenerating;

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
