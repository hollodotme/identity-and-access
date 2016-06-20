<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications\Events;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Domain\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationId;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationName;

/**
 * Class ApplicationWasRegistered
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications\Events
 */
final class ApplicationWasRegistered extends AbstractDomainEvent
{
	/** @var ApplicationId */
	private $id;

	/** @var ApplicationName */
	private $name;

	public function __construct( ApplicationId $id, ApplicationName $name )
	{
		$this->id   = $id;
		$this->name = $name;
	}

	public function getId() : ApplicationId
	{
		return $this->id;
	}

	public function getName() : ApplicationName
	{
		return $this->name;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->id->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'id'   => $this->id->toString(),
			'name' => $this->name->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->id   = new ApplicationId( $payload['id'] );
		$this->name = new ApplicationName( $payload['name'] );
	}
}