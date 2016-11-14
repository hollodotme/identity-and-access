<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\BlockTenantCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantsRepository;

/**
 * Class BlockTenantCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class BlockTenantCommandHandler extends AbstractCommandHandler
{
	public function handle( BlockTenantCommand $command )
	{
		$tenantsRepository = new TenantsRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$tenant = $tenantsRepository->findTenantWithId( $command->getTenantId() );
		$tenant->block();

		$tenantsRepository->saveChanges( $tenant );
	}
}
