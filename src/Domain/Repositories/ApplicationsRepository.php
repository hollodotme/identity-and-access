<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\Application;
use hollodotme\IdentityAndAccess\Domain\Models\Applications\ApplicationId;

/**
 * Class ApplicationsRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class ApplicationsRepository extends AbstractRepository
{
	public function findApplicationWithId( ApplicationId $applicationId ) : Application
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( 'Application' ),
			new StreamId( $applicationId->toString() ),
			$this->getEventMapper()
		);

		return new Application( $eventStream );
	}
}