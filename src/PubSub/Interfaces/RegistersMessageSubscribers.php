<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

use hollodotme\PubSub\Types\Channel;

/**
 * Interface RegistersMessageSubscribers
 * @package hollodotme\PubSub\Interfaces
 */
interface RegistersMessageSubscribers
{
	public function subscribe( Channel $channel, SubscribesToMessages $subscriber );
}