<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\UnblockTenantCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantsRepository;

/**
 * Class UnblockTenantCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class UnblockTenantCommandHandler extends AbstractCommandHandler
{
	public function handle( UnblockTenantCommand $command )
	{
		$tenantsRepository = new TenantsRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$tenant = $tenantsRepository->findTenantWithId( $command->getTenantId() );
		$tenant->unblock();

		$tenantsRepository->saveChanges( $tenant );
	}
}
