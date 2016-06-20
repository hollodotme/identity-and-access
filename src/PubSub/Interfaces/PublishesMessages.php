<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

/**
 * Interface PublishesMessages
 * @package hollodotme\PubSub\Interfaces
 */
interface PublishesMessages
{
	public function publish( TransfersInformation $message );
}