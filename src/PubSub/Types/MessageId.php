<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Types;

use hollodotme\PubSub\Interfaces\RepresentsValueAsString;
use hollodotme\PubSub\Traits\Scalarizing;

/**
 * Class MessageId
 * @package hollodotme\PubSub\Types
 */
final class MessageId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $messageId;

	public function __construct( string $messageId )
	{
		$this->messageId = $messageId;
	}

	public function toString() : string
	{
		return $this->messageId;
	}
}