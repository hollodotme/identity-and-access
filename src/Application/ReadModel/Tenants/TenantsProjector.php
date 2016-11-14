<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Tenants;

use hollodotme\IdentityAndAccess\Application\AbstractPushView;
use hollodotme\IdentityAndAccess\Application\WriteModel\EventEnvelope;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis\RedisManager;

/**
 * Class TenantsProjector
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Tenants
 */
final class TenantsProjector extends AbstractPushView
{
	/** @var RedisManager */
	private $redisManager;

	public function __construct( RedisManager $redisManager )
	{
		$this->redisManager = $redisManager;
	}

	protected function whenTenantWasRegistered( EventEnvelope $envelope )
	{
		/** @var TenantWasRegistered $event */
		$event = $envelope->getEvent();

		$this->redisManager->hSet(
			'tenants',
			$event->getTenantName()->toString(),
			$this->getJsonString(
				[
					'id'    => $event->getTenantId()->toString(),
					'state' => $event->getTenantState()->toString(),
				]
			)
		);
	}

	private function getJsonString( array $data ) : string
	{
		return json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
	}
}
