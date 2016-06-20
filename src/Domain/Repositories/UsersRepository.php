<?php
/**
 * @author h.woltersdorf
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Users\User;
use hollodotme\IdentityAndAccess\Domain\Models\Users\UserId;

/**
 * Class UsersRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class UsersRepository extends AbstractRepository
{
	public function findUserWithId( UserId $userId ) : User
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( 'User' ),
			new StreamId( $userId->toString() )
		);

		return User::reconstitute( $eventStream );
	}
}