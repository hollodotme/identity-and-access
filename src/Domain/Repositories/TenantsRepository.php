<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\Tenant;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use hollodotme\PubSub\Types\Channel;

/**
 * Class TenantsRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class TenantsRepository extends AbstractRepository
{
	const STREAM_NAME = 'Tenant';

	protected function getSubscribers() : array
	{
		return [ ];
	}

	protected function getSubscriptionChannel() : Channel
	{
		return new Channel( self::STREAM_NAME );
	}

	public function findTenantWithId( TenantId $tenantId ) : Tenant
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( self::STREAM_NAME ),
			new StreamId( $tenantId->toString() )
		);

		return Tenant::reconstitute( $eventStream );
	}
}