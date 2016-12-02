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

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Identities;

use hollodotme\IdentityAndAccess\Application\AbstractPushView;
use hollodotme\IdentityAndAccess\Application\ReadModel\Traits\ArrayToJsonConverting;
use hollodotme\IdentityAndAccess\Application\WriteModel\EventEnvelope;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityEmailWasChanged;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasBlocked;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasRegistered;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\Events\IdentityWasUnblocked;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\Redis\RedisManager;

/**
 * Class IdentitiesProjector
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Identities
 */
final class IdentitiesProjector extends AbstractPushView
{
	use ArrayToJsonConverting;

	/** @var RedisManager */
	private $redisManager;

	public function __construct( RedisManager $redisManager )
	{
		$this->redisManager = $redisManager;
	}

	protected function whenIdentityWasRegistered( EventEnvelope $envelope )
	{
		/** @var IdentityWasRegistered $event */
		$event = $envelope->getEvent();

		$this->redisManager->hSet(
			'identities',
			$event->getIdentityId()->toString(),
			$this->getJsonString(
				[
					'email'        => $event->getIdentityEmail(),
					'name'         => $event->getIdentityName(),
					'passwordHash' => $event->getIdentityPasswordHash(),
					'state'        => $event->getIdentityState(),
				]
			)
		);
	}

	protected function whenIdentityWasBlocked( EventEnvelope $envelope )
	{
		/** @var IdentityWasBlocked $event */
		$event = $envelope->getEvent();

		$identityJson      = $this->redisManager->hGet( 'identities', $event->getIdentityId()->toString() );
		$identity          = json_decode( $identityJson, true );
		$identity['state'] = $event->getIdentityState()->toString();

		$this->redisManager->hSet(
			'identities',
			$event->getIdentityId()->toString(),
			$this->getJsonString( $identity )
		);
	}

	protected function whenIdentityWasUnblocked( EventEnvelope $envelope )
	{
		/** @var IdentityWasUnblocked $event */
		$event = $envelope->getEvent();

		$identityJson      = $this->redisManager->hGet( 'identities', $event->getIdentityId()->toString() );
		$identity          = json_decode( $identityJson, true );
		$identity['state'] = $event->getIdentityState()->toString();

		$this->redisManager->hSet(
			'identities',
			$event->getIdentityId()->toString(),
			$this->getJsonString( $identity )
		);
	}

	protected function whenIdentityEmailWasChanged( EventEnvelope $envelope )
	{
		/** @var IdentityEmailWasChanged $event */
		$event = $envelope->getEvent();

		$identityJson      = $this->redisManager->hGet( 'identities', $event->getIdentityId()->toString() );
		$identity          = json_decode( $identityJson, true );
		$identity['email'] = $event->getIdentityEmail()->toString();

		$this->redisManager->hSet(
			'identities',
			$event->getIdentityId()->toString(),
			$this->getJsonString( $identity )
		);
	}
}
