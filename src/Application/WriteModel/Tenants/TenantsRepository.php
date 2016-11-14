<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Tenants;

use hollodotme\EventStore\Types\StreamId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\EventStore\Types\StreamSequence;
use hollodotme\IdentityAndAccess\Application\Constants\Stream;
use hollodotme\IdentityAndAccess\Application\WriteModel\AbstractRepository;
use IceHawk\PubSub\Types\Channel;

/**
 * Class TenantsRepository
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Tenants
 */
final class TenantsRepository extends AbstractRepository
{
	protected function getChannel() : Channel
	{
		return new Channel( Stream::TENANT );
	}

	public function findTenantWithId( TenantId $tenantId ) : Tenant
	{
		$eventStream = $this->getEventStore()->retrieveEntityStream(
			new StreamName( Stream::TENANT ),
			new StreamId( $tenantId->toString() ),
			new StreamSequence( 0 )
		);

		return Tenant::reconstitute( $eventStream );
	}
}
