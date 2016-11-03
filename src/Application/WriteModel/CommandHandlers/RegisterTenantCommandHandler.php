<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers;

use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterTenantCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Tenant;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantsRepository;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\UniqueTenantNameGuard;

/**
 * Class RegisterTenantCommandHandler
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\CommandHandlers
 */
final class RegisterTenantCommandHandler extends AbstractCommandHandler
{
	public function handle( RegisterTenantCommand $command )
	{
		$uniqueTenantNameGuard = new UniqueTenantNameGuard( $this->getEnv()->getEventStore() );

		$uniqueTenantNameGuard->guardTenantNameIsAvailable( $command->getTenantName() );

		$tenantsRepository = new TenantsRepository(
			$this->getEnv()->getEventStore(),
			$this->getEnv()->getMessageBus()
		);

		$tenantId = TenantId::generate();
		$tenant   = Tenant::register( $tenantId, $command->getTenantName() );

		$tenantsRepository->saveChanges( $tenant );
	}
}
