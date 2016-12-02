<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Validation;

use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\AbstractPullView;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityEmailWasChanged;
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
		$registeredIdentities = $this->getIdentityEmails();
		$identityId           = array_search( $email->toString(), $registeredIdentities );

		if ( $identityId !== false )
		{
			throw (new IdentityEmailAlreadyRegistered())->withIdentityEmailAndId( $email, $identityId );
		}
	}

	private function getIdentityEmails(): array
	{
		$registeredIdentities = [];

		$streamName  = StreamName::fromClassName( Identity::class );
		$eventStream = $this->pullNamedStream( $streamName );

		foreach ( $eventStream->getEventEnvelopes() as $envelope )
		{
			$event = $envelope->getEvent();

			if ( $event instanceof IdentityWasRegistered )
			{
				$registeredIdentities[ $event->getIdentityId()->toString() ] = $event->getIdentityEmail()->toString();
			}

			if ( $event instanceof IdentityEmailWasChanged )
			{
				$registeredIdentities[ $event->getIdentityId()->toString() ] = $event->getIdentityEmail()->toString();
			}
		}

		return $registeredIdentities;
	}
}
