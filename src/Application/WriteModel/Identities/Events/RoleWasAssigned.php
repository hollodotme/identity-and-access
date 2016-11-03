<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Roles\Role;

/**
 * Class RoleWasAssigned
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events
 */
final class RoleWasAssigned extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $identityId;

	/** @var Role */
	private $role;

	public function __construct( IdentityId $identityId, Role $role )
	{
		$this->identityId = $identityId;
		$this->role       = $role;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function getRole(): Role
	{
		return $this->role;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->identityId->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'identityId' => $this->identityId->toString(),
			'role'       => $this->role->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->identityId = new IdentityId( $payload['identityId'] );
		$this->role       = Role::fromString( $payload['role'] );
	}
}
