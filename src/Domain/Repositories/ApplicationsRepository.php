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
	public function findApplicationWithId( ApplicationId $id ) : Application
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( 'Application' ),
			new StreamId( $id->toString() )
		);

		return Application::reconstitute( $eventStream );
	}
}