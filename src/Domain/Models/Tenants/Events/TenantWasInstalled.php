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
 * Class TenantWasInstalled
 * @package hollodotme\IdentityAndAccess\Domain\Models\Tenants\Events
 */
final class TenantWasInstalled extends AbstractDomainEvent
{
	/** @var TenantId */
	private $id;

	/** @var TenantName */
	private $name;

	/** @var RepresentsTenantState */
	private $state;

	public function __construct( TenantId $id, TenantName $name, RepresentsTenantState $state )
	{
		$this->id    = $id;
		$this->name  = $name;
		$this->state = $state;
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

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->id->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'id'    => $this->id->toString(),
			'name'  => $this->name->toString(),
			'state' => $this->state->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->id    = new TenantId( $payload['id'] );
		$this->name  = new TenantName( $payload['name'] );
		$this->state = AbstractTenantState::fromString( $payload['state'] );
	}
}