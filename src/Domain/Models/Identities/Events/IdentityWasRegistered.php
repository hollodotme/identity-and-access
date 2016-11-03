<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Identities\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Domain\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Domain\Models\Identities\IdentityName;

/**
 * Class IdentityWasRegistered
 * @package hollodotme\IdentityAndAccess\Domain\Models\Identities\Events
 */
final class IdentityWasRegistered extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $ididentityId;

	/** @var IdentityEmail */
	private $identityEmail;

	/** @var IdentityName */
	private $identityName;

	public function __construct( IdentityId $id, IdentityEmail $email, IdentityName $name )
	{
		$this->ididentityId  = $id;
		$this->identityEmail = $email;
		$this->identityName  = $name;
	}

	public function getIdidentityId(): IdentityId
	{
		return $this->ididentityId;
	}

	public function getIdentityEmail(): IdentityEmail
	{
		return $this->identityEmail;
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
			'identityId'    => $this->ididentityId->toString(),
			'identityEmail' => $this->identityEmail->toString(),
			'identityName'  => $this->identityName->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->ididentityId  = new IdentityId( $payload['identityId'] );
		$this->identityEmail = new IdentityId( $payload['identityEmail'] );
		$this->identityName  = new IdentityId( $payload['identityName'] );
	}
}
