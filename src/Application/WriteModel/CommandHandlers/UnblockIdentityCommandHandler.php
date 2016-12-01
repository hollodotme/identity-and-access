<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\UnblockIdentityCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentitiesRepository;

/**
 * Class UnblockIdentityCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class UnblockIdentityCommandHandler extends AbstractCommandHandler
{
	public function handle( UnblockIdentityCommand $command )
	{
		$identitiesRepository = new IdentitiesRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$identity = $identitiesRepository->findIdentityWithId( $command->getIdentityId() );

		$identity->unblock();

		$identitiesRepository->saveChanges( $identity );
	}
}
