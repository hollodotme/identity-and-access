<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain;

use hollodotme\EventStore\Interfaces\EnclosesEvent;
use hollodotme\EventStore\Interfaces\ImpliesChange;
use hollodotme\EventStore\Types\EventHeader;
use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

/**
 * Class EventEnvelope
 * @package hollodotme\IdentityAndAccess\Domain
 */
final class EventEnvelope implements EnclosesEvent, CarriesInformation
{
	/** @var MessageId */
	private $messageId;

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
		$this->messageId = $this->buildMessageId( $header, $event );
		$this->header    = $header;
		$this->event     = $event;
	}

	private function buildMessageId( EventHeader $header, ImpliesChange $event ) : MessageId
	{
		$idString = sprintf(
			'%s:%s:%s:%s',
			$header->getStreamName()->toString(),
			$event->getStreamId()->toString(),
			$event->getEventId()->toString(),
			$header->getStreamSequence()->toString()
		);

		return new MessageId( $idString );
	}

	public function getMessageId() : IdentifiesMessage
	{
		return $this->messageId;
	}

	public function getMessageName() : NamesMessage
	{
		return new MessageName( $this->event->getEventName()->toString() );
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
