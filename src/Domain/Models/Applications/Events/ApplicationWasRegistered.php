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
	private $applicationId;

	/** @var ApplicationName */
	private $applicationName;

	public function __construct( ApplicationId $applicationId, ApplicationName $applicationName )
	{
		$this->applicationId   = $applicationId;
		$this->applicationName = $applicationName;
	}

	public function getApplicationId() : ApplicationId
	{
		return $this->applicationId;
	}

	public function getApplicationName() : ApplicationName
	{
		return $this->applicationName;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->applicationId->toString() );
	}

	protected function toPayload() : array
	{
		return [
			'applicationId'   => $this->applicationId->toString(),
			'applicationName' => $this->applicationName->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->applicationId   = new ApplicationId( $payload['applicationId'] );
		$this->applicationName = new ApplicationName( $payload['applicationName'] );
	}
}