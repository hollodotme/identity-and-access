<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants;

use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\UnblockedState;

/**
 * Class Tenant
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants
 */
final class Tenant
{
	/** @var TenantId */
	private $tenantId;

	/** @var TenantName */
	private $name;

	/** @var RepresentsTenantState */
	private $state;

	public function __construct( TenantId $tenantId, TenantName $name )
	{
		$this->tenantId = $tenantId;
		$this->name     = $name;

		$this->setState( new UnblockedState() );
	}

	private function setState( RepresentsTenantState $tenantState )
	{
		$this->state = $tenantState;
	}

	public function block()
	{
		$this->setState( $this->state->block() );
	}

	public function unblock()
	{
		$this->setState( $this->state->unblock() );
	}

	public function changeName( TenantName $name )
	{
		$this->name = $name;
	}

	public function getTenantId() : TenantId
	{
		return $this->tenantId;
	}

	public function getName() : TenantName
	{
		return $this->name;
	}

	public function getState() : RepresentsTenantState
	{
		return $this->state;
	}
}