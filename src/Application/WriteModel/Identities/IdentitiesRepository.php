<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Application\Constants\Stream;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractRepository;
use IceHawk\PubSub\Types\Channel;

/**
 * Class IdentitiesRepository
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class IdentitiesRepository extends AbstractRepository
{
	protected function getChannel(): Channel
	{
		return new Channel( Stream::IDENTITY );
	}

	public function findIdentityWithId( IdentityId $identityId ): Identity
	{
		$eventStream = $this->getEventStore()->retrieveEntityStream(
			new StreamName( Stream::IDENTITY ),
			new StreamId( $identityId->toString() ),
			new StreamSequence( 0 )
		);

		return Identity::reconstitute( $eventStream );
	}
}
