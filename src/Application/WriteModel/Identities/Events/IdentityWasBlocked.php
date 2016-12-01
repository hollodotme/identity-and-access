<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\AbstractIdentityState;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Interfaces\RepresentsIdentityState;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

/**
 * Class IdentityWasBlocked
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events
 */
final class IdentityWasBlocked extends AbstractDomainEvent
{
	/** @var IdentityId */
	private $identityId;

	/** @var RepresentsIdentityState */
	private $identityState;

	public function __construct( IdentityId $identityId, RepresentsIdentityState $identityState )
	{
		$this->identityId    = $identityId;
		$this->identityState = $identityState;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
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
			'identityId'    => $this->identityId->toString(),
			'identityState' => $this->identityState->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->identityId    = new IdentityId( new UUID( $payload['identityId'] ) );
		$this->identityState = AbstractIdentityState::fromString( $payload['identityState'] );
	}
}
