<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityName;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityPasswordHash;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\AbstractIdentityState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

/**
 * Class IdentityWasRegistered
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events
 */
final class IdentityWasRegistered extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $identityId;

	/** @var IdentityEmail */
	private $identityEmail;

	/** @var IdentityPasswordHash */
	private $identityPasswordHash;

	/** @var IdentityName */
	private $identityName;

	/** @var RepresentsIdentityState */
	private $identityState;

	public function __construct(
		IdentityId $id,
		IdentityEmail $email,
		IdentityPasswordHash $passwordHash,
		IdentityName $name,
		RepresentsIdentityState $state
	)
	{
		$this->identityId           = $id;
		$this->identityEmail        = $email;
		$this->identityPasswordHash = $passwordHash;
		$this->identityName         = $name;
		$this->identityState = $state;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function getIdentityEmail(): IdentityEmail
	{
		return $this->identityEmail;
	}

	public function getIdentityPasswordHash(): IdentityPasswordHash
	{
		return $this->identityPasswordHash;
	}

	public function getIdentityName(): IdentityName
	{
		return $this->identityName;
	}

	public function getIdentityState(): RepresentsIdentityState
	{
		return $this->identityState;
	}

	public function getStreamId(): StreamId
	{
		return new StreamId( $this->identityId->toString() );
	}

	protected function toPayload(): array
	{
		return [
			'identityId'           => $this->identityId->toString(),
			'identityEmail'        => $this->identityEmail->toString(),
			'identityPasswordHash' => $this->identityPasswordHash->toString(),
			'identityName'         => $this->identityName->toString(),
			'identityState'        => $this->identityState->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->identityId           = new IdentityId( new UUID( $payload['identityId'] ) );
		$this->identityEmail        = new IdentityEmail( $payload['identityEmail'] );
		$this->identityPasswordHash = new IdentityPasswordHash( $payload['identityPasswordHash'] );
		$this->identityName         = new IdentityName( $payload['identityName'] );
		$this->identityState = AbstractIdentityState::fromString( $payload['identityState'] );
	}
}
