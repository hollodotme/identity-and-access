<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Commands;

use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Interfaces\CarriesInstruction;

/**
 * Class BlockTenantCommand
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Commands
 */
final class BlockTenantCommand implements CarriesInstruction
{
	/** @var TenantId */
	private $tenantId;

	public function __construct( TenantId $tenantId )
	{
		$this->tenantId = $tenantId;
	}

	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}
}
