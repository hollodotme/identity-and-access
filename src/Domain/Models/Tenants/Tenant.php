<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants;

use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\UnblockedState;

/**
 * Class Tenant
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants
 */
final class Tenant extends AbstractAggregateRoot
{
	/** @var TenantId */
	private $id;

	/** @var TenantName */
	private $name;

	/** @var RepresentsTenantState */
	private $state;

	public static function install( TenantId $id, TenantName $name ) : self
	{
		$tenant = new self();
		$tenant->trackThat( new TenantWasRegistered( $id, $name, new UnblockedState() ) );

		return $tenant;
	}

	protected function whenTenantWasRegistered( TenantWasRegistered $event )
	{
		$this->id   = $event->getTenantId();
		$this->name = $event->getTenantName();
		$this->setState( $event->getTenantState() );
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

	public function getId() : TenantId
	{
		return $this->id;
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
