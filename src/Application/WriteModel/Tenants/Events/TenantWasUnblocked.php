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
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantName;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

/**
 * Class TenantWasUnblocked
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events
 */
final class TenantWasUnblocked extends AbstractDomainEvent
{
	/** @var TenantId */
	private $tenantId;

	/** @var TenantName */
	private $tenantName;

	/** @var RepresentsTenantState */
	private $tenantState;

	public function __construct( TenantId $tenantId, TenantName $tenantName, RepresentsTenantState $tenantState )
	{
		$this->tenantId    = $tenantId;
		$this->tenantName  = $tenantName;
		$this->tenantState = $tenantState;
	}

	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}

	public function getTenantName(): TenantName
	{
		return $this->tenantName;
	}

	public function getTenantState(): RepresentsTenantState
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
		$this->tenantId    = new TenantId( new UUID( $payload['tenantId'] ) );
		$this->tenantName  = new TenantName( $payload['tenantName'] );
		$this->tenantState = AbstractTenantState::fromString( $payload['tenantState'] );
	}
}
