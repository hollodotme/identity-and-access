<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain;

use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Types\EventHeader;
use hollodotme\PubSub\Interfaces\TransfersInformation;
use hollodotme\PubSub\Types\MessageId;
use hollodotme\PubSub\Types\MessageName;

/**
 * Class EventEnvelope
 * @package hollodotme\IdentityAndAccess\Domain
 */
final class EventEnvelope implements EnclosesEvent, TransfersInformation
{
	/** @var MessageId */
	private $messageId;

	/** @var MessageName */
	private $messageName;

	/** @var EventHeader */
	private $header;

	/** @var ImpliesChange */
	private $event;

	/**
	 * @param EventHeader   $header
	 * @param ImpliesChange $event
	 */
	public function __construct( EventHeader $header, ImpliesChange $event )
	{
		$this->messageId   = $this->buildMessageId( $header, $event );
		$this->messageName = new MessageName( $event->getId()->toString() );

		$this->header = $header;
		$this->event  = $event;
	}

	private function buildMessageId( EventHeader $header, ImpliesChange $event ) : MessageId
	{
		$idString = sprintf(
			'%s:%s:%s',
			$header->getStreamName()->toString(),
			$event->getId()->toString(),
			$header->getStreamSequence()->toString()
		);

		return new MessageId( $idString );
	}

	public function getMessageId() : MessageId
	{
		return $this->messageId;
	}

	public function getMessageName() : MessageName
	{
		return $this->messageName;
	}

	public function getHeader() : EventHeader
	{
		return $this->header;
	}

	public function getEvent() : ImpliesChange
	{
		return $this->event;
	}
}