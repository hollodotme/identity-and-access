<?php
/**
 * @author h.woltersdorf
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Domain\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Domain\Models\Users\States\AbstractUserState;
use hollodotme\IdentityAndAccess\Domain\Models\Users\States\Interfaces\RepresentsUserState;
use hollodotme\IdentityAndAccess\Domain\Models\Users\UserId;
use hollodotme\IdentityAndAccess\Domain\Models\Users\UserName;

/**
 * Class UserWasInstalled
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\Events
 */
final class UserWasInstalled extends AbstractDomainEvent
{
	/** @var TenantId */
	private $tenantId;

	/** @var UserId */
	private $id;

	/** @var UserName */
	private $name;

	/** @var RepresentsUserState */
	private $state;

	public function __construct( TenantId $tenantId, UserId $id, UserName $name, RepresentsUserState $state )
	{
		$this->tenantId = $tenantId;
		$this->id       = $id;
		$this->name     = $name;
		$this->state    = $state;
	}

	public function getTenantId() : TenantId
	{
		return $this->tenantId;
	}

	public function getId() : UserId
	{
		return $this->id;
	}

	public function getName() : UserName
	{
		return $this->name;
	}

	public function getState() : RepresentsUserState
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
			'tenantId' => $this->tenantId->toString(),
			'id'       => $this->id->toString(),
			'name'     => $this->name->toString(),
			'state'    => $this->name->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->tenantId = new TenantId( $payload['tenantId'] );
		$this->id       = new UserId( $payload['id'] );
		$this->name     = new UserName( $payload['name'] );
		$this->state    = AbstractUserState::fromString( $payload['state'] );
	}
}