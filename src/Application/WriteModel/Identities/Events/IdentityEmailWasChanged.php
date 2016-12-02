<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

/**
 * Class IdentityEmailWasChanged
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events
 */
final class IdentityEmailWasChanged extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $identityId;

	/** @var IdentityEmail */
	private $identityEmail;

	public function __construct( IdentityId $identityId, IdentityEmail $identityEmail )
	{
		$this->identityId    = $identityId;
		$this->identityEmail = $identityEmail;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function getIdentityEmail(): IdentityEmail
	{
		return $this->identityEmail;
	}

	public function getStreamId(): StreamId
	{
		return new StreamId( $this->identityId->toString() );
	}

	protected function toPayload(): array
	{
		return [
			'identityId'    => $this->identityId->toString(),
			'identityEmail' => $this->identityEmail->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->identityId    = new IdentityId( new UUID( $payload['identityId'] ) );
		$this->identityEmail = new IdentityEmail( $payload['identityEmail'] );
	}
}
