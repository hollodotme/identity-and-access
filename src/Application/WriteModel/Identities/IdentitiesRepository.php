<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractRepository;
use IceHawk\PubSub\Types\Channel;

/**
 * Class IdentitiesRepository
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class IdentitiesRepository extends AbstractRepository
{
	const STREAM_NAME = 'Identity';

	protected function getChannel() : Channel
	{
		return new Channel( self::STREAM_NAME );
	}

	public function findIdentityWithId( IdentityId $identityId ) : Identity
	{
		$eventStream = $this->getEventStore()->retrieveEntityStream(
			new StreamName( self::STREAM_NAME ),
			new StreamId( $identityId->toString() ),
			new StreamSequence( 0 )
		);

		return Identity::reconstitute( $eventStream );
	}
}
