<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Validation;

use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\AbstractPullView;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions\IdentityEmailAlreadyRegistered;

/**
 * Class UniqueIdentityEmailGuard
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Validation
 */
final class UniqueIdentityEmailGuard extends AbstractPullView
{
	public function guardIdentityEmailIsAvailable( IdentityEmail $email )
	{
		$registeredTenants = $this->getRegisteredIdentities();

		if ( isset($registeredTenants[ $email->toString() ]) )
		{
			throw (new IdentityEmailAlreadyRegistered())->withIdentityEmailAndId(
				$email,
				$registeredTenants[ $email->toString() ]
			);
		}
	}

	private function getRegisteredIdentities() : array
	{
		$registeredTenants = [];

		$streamName  = StreamName::fromClassName( Identity::class );
		$eventStream = $this->pullNamedStream( $streamName );

		foreach ( $eventStream->getEventEnvelopes() as $envelope )
		{
			$event = $envelope->getEvent();

			if ( $event instanceof IdentityWasRegistered )
			{
				$registeredTenants[ $event->getIdentityEmail()->toString() ] = $event->getIdentityId();
			}
		}

		return $registeredTenants;
	}
}
