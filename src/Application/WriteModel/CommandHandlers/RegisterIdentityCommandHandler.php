<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterIdentityCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentitiesRepository;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\UniqueIdentityEmailGuard;

/**
 * Class RegisterIdentityCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class RegisterIdentityCommandHandler extends AbstractCommandHandler
{
	public function handle( RegisterIdentityCommand $command )
	{
		$uniqueIdentityEmailGuard = new UniqueIdentityEmailGuard( $this->getEnv()->getEventStore() );

		$uniqueIdentityEmailGuard->guardIdentityEmailIsAvailable( $command->getEmail() );

		$identityRepository = new IdentitiesRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$identity = Identity::register(
			IdentityId::generate(),
			$command->getEmail(),
			$command->getPasswordHash(),
			$command->getName()
		);

		$identityRepository->saveChanges( $identity );
	}
}
