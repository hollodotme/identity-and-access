<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Types;

use hollodotme\EventStore\Interfaces\RepresentsValueAsString;
use hollodotme\EventStore\Traits\Scalarizing;

/**
 * Class OccurredOn
 * @package hollodotme\EventStore\Types
 */
final class OccurredOn implements RepresentsValueAsString
{
	use Scalarizing;

	const FORMAT = 'Y-m-d H:i:s';

	/** @var \DateTimeInterface */
	private $occurredOn;

	public function __construct( \DateTimeInterface $occurredOn )
	{
		$this->occurredOn = $occurredOn;
	}

	public function toString() : string
	{
		return $this->occurredOn->format( self::FORMAT );
	}

	public static function fromDateTimeString( string $dateTimeString ) : self
	{
		$dateTime = new \DateTimeImmutable( $dateTimeString );

		return new self( $dateTime );
	}
}