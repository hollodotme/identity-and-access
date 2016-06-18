<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications;

use hollodotme\EventStore\Types\EventStream;
use hollodotme\EventStore\Types\StreamId;
use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\Events\ApplicationWasRegisteredEvent;

/**
 * Class Application
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications
 */
final class Application extends AbstractAggregateRoot
{
	/** @var ApplicationId */
	private $applicationId;

	/** @var ApplicationName */
	private $name;

	public static function register( ApplicationId $applicationId, ApplicationName $name ) : self
	{
		$application = new Application( new EventStream() );
		$application->publish( new ApplicationWasRegisteredEvent( $applicationId, $name ) );

		return $application;
	}

	public function getApplicationId() : ApplicationId
	{
		return $this->applicationId;
	}

	public function getName() : ApplicationName
	{
		return $this->name;
	}

	public function getStreamId() : StreamId
	{
		return new StreamId( $this->applicationId->toString() );
	}
}