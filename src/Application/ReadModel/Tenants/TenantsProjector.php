<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Tenants;

use hollodotme\IdentityAndAccess\Application\AbstractPushView;
use hollodotme\IdentityAndAccess\Application\ReadModel\Traits\ArrayToJsonConverting;
use hollodotme\IdentityAndAccess\Application\WriteModel\EventEnvelope;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\Events\TenantWasUnblocked;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis\RedisManager;

/**
 * Class TenantsProjector
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Tenants
 */
final class TenantsProjector extends AbstractPushView
{
	use ArrayToJsonConverting;

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
			$event->getTenantId()->toString(),
			$this->getJsonString(
				[
					'name'  => $event->getTenantName()->toString(),
					'state' => $event->getTenantState()->toString(),
				]
			)
		);
	}

	protected function whenTenantWasBlocked( EventEnvelope $envelope )
	{
		/** @var TenantWasRegistered $event */
		$event = $envelope->getEvent();

		$tenantJson      = $this->redisManager->hGet( 'tenants', $event->getTenantId()->toString() );
		$tenant          = json_decode( $tenantJson, true );
		$tenant['state'] = $event->getTenantState()->toString();

		$this->redisManager->hSet(
			'tenants',
			$event->getTenantId()->toString(),
			$this->getJsonString( $tenant )
		);
	}

	protected function whenTenantWasUnblocked( EventEnvelope $envelope )
	{
		/** @var TenantWasUnblocked $event */
		$event = $envelope->getEvent();

		$tenantJson      = $this->redisManager->hGet( 'tenants', $event->getTenantId()->toString() );
		$tenant          = json_decode( $tenantJson, true );
		$tenant['state'] = $event->getTenantState()->toString();

		$this->redisManager->hSet(
			'tenants',
			$event->getTenantId()->toString(),
			$this->getJsonString( $tenant )
		);
	}
}
