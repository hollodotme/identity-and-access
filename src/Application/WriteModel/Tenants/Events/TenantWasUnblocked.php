<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\AbstractTenantState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Interfaces\RepresentsTenantState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

/**
 * Class TenantWasUnblocked
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events
 */
final class TenantWasUnblocked extends AbstractDomainEvent
{
	/** @var TenantId */
	private $tenantId;

	/** @var RepresentsTenantState */
	private $tenantState;

	public function __construct( TenantId $tenantId, RepresentsTenantState $tenantState )
	{
		$this->tenantId    = $tenantId;
		$this->tenantState = $tenantState;
	}

	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}

	public function getTenantState(): RepresentsTenantState
	{
		return $this->tenantState;
	}

	public function getStreamId(): StreamId
	{
		return new StreamId( $this->tenantId->toString() );
	}

	protected function toPayload(): array
	{
		return [
			'tenantId'    => $this->tenantId->toString(),
			'tenantState' => $this->tenantState->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->tenantId    = new TenantId( new UUID( $payload['tenantId'] ) );
		$this->tenantState = AbstractTenantState::fromString( $payload['tenantState'] );
	}
}
