<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\Application;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationId;
use hollodotme\PubSub\Types\Channel;

/**
 * Class ApplicationsRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class ApplicationsRepository extends AbstractRepository
{
	const STREAM_NAME = 'Application';

	protected function getSubscribers() : array
	{
		return [ ];
	}

	protected function getSubscriptionChannel() : Channel
	{
		return new Channel( self::STREAM_NAME );
	}

	public function findApplicationWithId( ApplicationId $id ) : Application
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( self::STREAM_NAME ),
			new StreamId( $id->toString() )
		);

		return Application::reconstitute( $eventStream );
	}
}