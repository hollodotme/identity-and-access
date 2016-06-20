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
	private $userId;

	/** @var UserName */
	private $userName;

	/** @var RepresentsUserState */
	private $userState;

	public function __construct(
		TenantId $tenantId, UserId $userId, UserName $userName, RepresentsUserState $userState
	)
	{
		$this->tenantId  = $tenantId;
		$this->userId    = $userId;
		$this->userName  = $userName;
		$this->userState = $userState;
	}

	public function getTenantId() : TenantId
	{
		return $this->tenantId;
	}

	public function getUserId() : UserId
	{
		return $this->userId;
	}

	public function getUserName() : UserName
	{
		return $this->userName;
	}

	public function getUserState() : RepresentsUserState
	{
		return $this->userState;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->userId->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'tenantId'  => $this->tenantId->toString(),
			'userId'    => $this->userId->toString(),
			'userName'  => $this->userName->toString(),
			'userState' => $this->userState->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->tenantId  = new TenantId( $payload['tenantId'] );
		$this->userId    = new UserId( $payload['userId'] );
		$this->userName  = new UserName( $payload['userName'] );
		$this->userState = AbstractUserState::fromString( $payload['userState'] );
	}
}