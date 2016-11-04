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

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Validation;

use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\AbstractPullView;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Tenant;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantName;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions\TenantNameAlreadyRegistered;

/**
 * Class UniqueTenantsNameGuard
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Validation
 */
final class UniqueTenantNameGuard extends AbstractPullView
{
	public function guardTenantNameIsAvailable( TenantName $tenantName )
	{
		$registeredTenants = $this->getRegisteredTenants();

		if ( isset($registeredTenants[ $tenantName->toString() ]) )
		{
			throw (new TenantNameAlreadyRegistered())->withTenantNameAndId(
				$tenantName,
				$registeredTenants[ $tenantName->toString() ]
			);
		}
	}

	private function getRegisteredTenants() : array
	{
		$registeredTenants = [];

		$streamName  = StreamName::fromClassName( Tenant::class );
		$eventStream = $this->pullNamedStream( $streamName );

		foreach ( $eventStream->getEventEnvelopes() as $envelope )
		{
			$event = $envelope->getEvent();

			if ( $event instanceof TenantWasRegistered )
			{
				$registeredTenants[ $event->getTenantName()->toString() ] = $event->getTenantId();
			}
		}

		return $registeredTenants;
	}
}
