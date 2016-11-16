<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants;

use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasUnblocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\UnblockedState;

/**
 * Class Tenant
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants
 */
final class Tenant extends AbstractAggregateRoot
{
	/** @var TenantId */
	private $id;

	/** @var TenantName */
	private $name;

	/** @var RepresentsTenantState */
	private $state;

	public static function register( TenantId $id, TenantName $name ) : self
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
		$this->trackThat( new TenantWasBlocked( $this->id, $this->name, $this->state->block() ) );
	}

	protected function whenTenantWasBlocked( TenantWasBlocked $event )
	{
		$this->setState( $event->getTenantState() );
	}

	public function unblock()
	{
		$this->trackThat( new TenantWasUnblocked( $this->id, $this->name, $this->state->unblock() ) );
	}

	protected function whenTenantWasUnblocked( TenantWasUnblocked $event )
	{
		$this->setState( $event->getTenantState() );
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
