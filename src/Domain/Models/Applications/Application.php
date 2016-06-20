<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications;

use hollodotme\IdentityAndAccess\Domain\Models\AbstractAggregateRoot;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\Events\ApplicationWasRegistered;

/**
 * Class Application
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications
 */
final class Application extends AbstractAggregateRoot
{
	/** @var ApplicationId */
	private $id;

	/** @var ApplicationName */
	private $name;

	public static function register( ApplicationId $id, ApplicationName $name ) : self
	{
		$application = new Application();
		$application->trackThat( new ApplicationWasRegistered( $id, $name ) );

		return $application;
	}

	public function whenApplicationWasRegistered( ApplicationWasRegistered $event )
	{
		$this->id   = $event->getId();
		$this->name = $event->getName();
	}

	public function getId() : ApplicationId
	{
		return $this->id;
	}

	public function getName() : ApplicationName
	{
		return $this->name;
	}
}