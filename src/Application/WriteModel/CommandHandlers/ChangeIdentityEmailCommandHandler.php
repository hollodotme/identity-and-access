<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\ChangeIdentityEmailCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentitiesRepository;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\UniqueIdentityEmailGuard;

/**
 * Class ChangeIdentityEmailCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class ChangeIdentityEmailCommandHandler extends AbstractCommandHandler
{
	public function handle( ChangeIdentityEmailCommand $command )
	{
		$eventStore = $this->getEnv()->getEventStore();
		$validator  = new UniqueIdentityEmailGuard( $eventStore );

		$validator->guardIdentityEmailIsAvailable( $command->getIdentityEmail() );

		$identitiesRepository = new IdentitiesRepository(
			$eventStore,
			$this->getEnv()->getMessageBus()
		);

		$identity = $identitiesRepository->findIdentityWithId( $command->getIdentityId() );

		$identity->changeEmail( $command->getIdentityEmail() );

		$identitiesRepository->saveChanges( $identity );
	}
}
