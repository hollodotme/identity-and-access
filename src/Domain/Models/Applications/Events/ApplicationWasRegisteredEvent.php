<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications\Events;

use hollodotme\IdentityAndAccess\Domain\AbstractDomainEvent;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationId;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationName;

/**
 * Class ApplicationWasRegisteredEvent
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications\Events
 */
final class ApplicationWasRegisteredEvent extends AbstractDomainEvent
{
	/** @var ApplicationId */
	private $applicationId;

	/** @var ApplicationName */
	private $name;

	public function __construct( ApplicationId $applicationId, ApplicationName $name )
	{
		$this->applicationId = $applicationId;
		$this->name          = $name;
	}

	protected function toPayload() : array
	{
		return [
			'applicationId' => $this->applicationId->toString(),
			'name'          => $this->name->toString(),
		];
	}

	protected function fromPayload( array $payload )
	{
		$this->applicationId = new ApplicationId( $payload['applicationId'] );
		$this->name          = new ApplicationName( $payload['applicationId'] );
	}
}