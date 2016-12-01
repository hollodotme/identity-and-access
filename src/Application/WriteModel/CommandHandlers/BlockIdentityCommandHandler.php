<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\BlockIdentityCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentitiesRepository;

/**
 * Class BlockIdentityCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class BlockIdentityCommandHandler extends AbstractCommandHandler
{
	public function handle( BlockIdentityCommand $command )
	{
		$identitiesRepository = new IdentitiesRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$identity = $identitiesRepository->findIdentityWithId( $command->getIdentityId() );

		$identity->block();

		$identitiesRepository->saveChanges( $identity );
	}
}
