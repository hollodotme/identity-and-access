<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub;

use hollodotme\PubSub\Interfaces\DispatchesMessages;
use hollodotme\PubSub\Interfaces\SubscribesToMessages;
use hollodotme\PubSub\Interfaces\TransfersInformation;
use hollodotme\PubSub\Types\MessageName;

/**
 * Class MessageBus
 * @package hollodotme\PubSub
 */
final class MessageBus implements DispatchesMessages
{
	/** @var array|SubscribesToMessages[][] */
	private $subscriptions;

	public function __construct()
	{
		$this->subscriptions = [ ];
	}

	public function publish( TransfersInformation $message )
	{
		$subscribers = $this->getSubscribersForMessageName( $message->getMessageName() );

		/** @var SubscribesToMessages $subscriber */
		foreach ( $subscribers as $subscriber )
		{
			$subscriber->notify( $message );
		}
	}

	/**
	 * @param MessageName $messageName
	 *
	 * @return array|SubscribesToMessages[]
	 */
	private function getSubscribersForMessageName( MessageName $messageName ) : array
	{
		$subscribers = [ ];

		foreach ( $this->subscriptions as $msgName => $msgSubscribers )
		{
			if ( $messageName->equalsString( $msgName ) )
			{
				$subscribers = array_merge( $subscribers, $msgSubscribers );
			}
		}

		return $subscribers;
	}

	public function subscribe( MessageName $messageName, SubscribesToMessages $subscriber )
	{
		$key = $messageName->toString();

		if ( isset($this->subscriptions[ $key ]) )
		{
			if ( !in_array( $subscriber, $this->subscriptions[ $key ], true ) )
			{
				$this->subscriptions[ $key ][] = $subscriber;
			}
		}
		else
		{
			$this->subscriptions[ $key ] = [ $subscriber ];
		}
	}
}