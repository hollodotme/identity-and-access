<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Tenants\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Domain\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\AbstractTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantName;

/**
 * Class TenantWasRegistered
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\Events
 */
final class TenantWasRegistered extends AbstractDomainEvent
{
	/** @var TenantId */
	private $tenantId;

	/** @var TenantName */
	private $tenantName;

	/** @var RepresentsTenantState */
	private $tenantState;

	public function __construct( TenantId $tenantId, TenantName $tenantName, RepresentsTenantState $state )
	{
		$this->tenantId    = $tenantId;
		$this->tenantName  = $tenantName;
		$this->tenantState = $state;
	}

	public function getTenantId() : TenantId
	{
		return $this->tenantId;
	}

	public function getTenantName() : TenantName
	{
		return $this->tenantName;
	}

	public function getTenantState() : RepresentsTenantState
	{
		return $this->tenantState;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->tenantId->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'tenantId'    => $this->tenantId->toString(),
			'tenantName'  => $this->tenantName->toString(),
			'tenantState' => $this->tenantState->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->tenantId    = new TenantId( $payload['tenantId'] );
		$this->tenantName  = new TenantName( $payload['tenantName'] );
		$this->tenantState = AbstractTenantState::fromString( $payload['tenantState'] );
	}
}