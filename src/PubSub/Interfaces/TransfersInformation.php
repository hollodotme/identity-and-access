<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

use hollodotme\PubSub\Types\MessageId;
use hollodotme\PubSub\Types\MessageName;

/**
 * Interface TransfersInformation
 * @package hollodotme\PubSub\Interfaces
 */
interface TransfersInformation
{
	public function getMessageId() : MessageId;

	public function getMessageName() : MessageName;
}