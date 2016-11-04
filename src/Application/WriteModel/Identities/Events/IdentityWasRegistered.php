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

/**
 * Class IdentityWasRegistered
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events
 */
final class IdentityWasRegistered extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $ididentityId;

	/** @var IdentityEmail */
	private $identityEmail;

	/** @var IdentityPasswordHash */
	private $identityPasswordHash;

	/** @var IdentityName */
	private $identityName;

	public function __construct(
		IdentityId $id,
		IdentityEmail $email,
		IdentityPasswordHash $passwordHash,
		IdentityName $name
	)
	{
		$this->ididentityId         = $id;
		$this->identityEmail        = $email;
		$this->identityPasswordHash = $passwordHash;
		$this->identityName         = $name;
	}

	public function getIdidentityId(): IdentityId
	{
		return $this->ididentityId;
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

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->ididentityId->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'identityId'           => $this->ididentityId->toString(),
			'identityEmail'        => $this->identityEmail->toString(),
			'identityPasswordHash' => $this->identityPasswordHash->toString(),
			'identityName'         => $this->identityName->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->ididentityId         = new IdentityId( $payload['identityId'] );
		$this->identityEmail        = new IdentityId( $payload['identityEmail'] );
		$this->identityPasswordHash = new IdentityId( $payload['identityPasswordHash'] );
		$this->identityName         = new IdentityId( $payload['identityName'] );
	}
}
