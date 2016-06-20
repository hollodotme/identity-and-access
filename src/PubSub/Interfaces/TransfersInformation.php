<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

use hollodotme\PubSub\Types\Channel;
use hollodotme\PubSub\Types\MessageId;

/**
 * Interface TransfersInformation
 * @package hollodotme\PubSub\Interfaces
 */
interface TransfersInformation
{
	public function getMessageId() : MessageId;

	public function getChannel() : Channel;
}