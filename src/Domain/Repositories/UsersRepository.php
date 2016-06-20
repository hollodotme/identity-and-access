<?php
/**
 * @author h.woltersdorf
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Users\User;
use hollodotme\IdentityAndAccess\Domain\Models\Users\UserId;
use hollodotme\PubSub\Types\Channel;

/**
 * Class UsersRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class UsersRepository extends AbstractRepository
{
	const STREAM_NAME = 'User';

	protected function getSubscribers() : array
	{
		return [ ];
	}

	protected function getSubscriptionChannel() : Channel
	{
		return new Channel( self::STREAM_NAME );
	}

	public function findUserWithId( UserId $userId ) : User
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( self::STREAM_NAME ),
			new StreamId( $userId->toString() )
		);

		return User::reconstitute( $eventStream );
	}
}