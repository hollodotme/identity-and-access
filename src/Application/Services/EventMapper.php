<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Services;

use hollodotme\EventStore\AbstractEventMapper;
use hollodotme\EventStore\Types\EventId;
use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Application\Exceptions\LoadingEventMapFailed;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasUnblocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasUnblocked;

/**
 * Class EventMapper
 * @package hollodotme\IdentityAndAccess\Application\Services
 */
final class EventMapper extends AbstractEventMapper
{
	const MAP = [
		'TenantWasRegistered'   => TenantWasRegistered::class,
		'TenantWasBlocked'      => TenantWasBlocked::class,
		'TenantWasUnblocked'    => TenantWasUnblocked::class,
		'IdentityWasRegistered' => IdentityWasRegistered::class,
		'IdentityWasBlocked'    => IdentityWasBlocked::class,
		'IdentityWasUnblocked'  => IdentityWasUnblocked::class,
	];

	protected function getEventClass( StreamName $streamName, EventId $eventId ): string
	{
		$key = $eventId->toString();

		if ( !array_key_exists( $key, self::MAP ) )
		{
			throw (new LoadingEventMapFailed())->withStreamNameAndEventId( $streamName, $eventId );
		}

		return self::MAP[ $key ];
	}
}
