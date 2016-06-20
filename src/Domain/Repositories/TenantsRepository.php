<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Repositories;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\Tenant;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;

/**
 * Class TenantsRepository
 * @package hollodotme\IdentityAndAccess\Domain\Repositories
 */
final class TenantsRepository extends AbstractRepository
{
	public function findTenantWithId( TenantId $tenantId ) : Tenant
	{
		$eventStream = $this->getEventStore()->retrieveEventStream(
			new StreamName( 'Tenant' ),
			new StreamId( $tenantId->toString() )
		);

		return Tenant::reconstitute( $eventStream );
	}
}