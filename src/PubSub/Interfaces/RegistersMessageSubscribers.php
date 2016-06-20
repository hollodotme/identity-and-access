<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

use hollodotme\PubSub\Types\MessageName;

/**
 * Interface RegistersMessageSubscribers
 * @package hollodotme\PubSub\Interfaces
 */
interface RegistersMessageSubscribers
{
	public function subscribe( MessageName $messageName, SubscribesToMessages $subscriber );
}