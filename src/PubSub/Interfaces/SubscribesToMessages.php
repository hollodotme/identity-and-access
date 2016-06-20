<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

/**
 * Interface SubscribesToMessages
 * @package hollodotme\PubSub\Interfaces
 */
interface SubscribesToMessages
{
	public function notify( TransfersInformation $message );
}