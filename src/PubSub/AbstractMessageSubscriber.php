<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub;

use hollodotme\PubSub\Interfaces\SubscribesToMessages;
use hollodotme\PubSub\Interfaces\TransfersInformation;

/**
 * Class AbstractMessageSubscriber
 * @package hollodotme\PubSub
 */
abstract class AbstractMessageSubscriber implements SubscribesToMessages
{
	final public function notify( TransfersInformation $message )
	{
		$methodName = 'on' . $message->getChannel();

		if ( method_exists( $this, $methodName ) )
		{
			call_user_func( [ $this, $methodName ], $message );
		}
	}
}