<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Exceptions;

use hollodotme\EventStore\Types\StreamName;
use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class LoadingEventMapFailed
 * @package hollodotme\IdentityAndAccess\Domain\Exceptions
 */
final class LoadingEventMapFailed extends IdentityAndAccessException
{
	/** @var StreamName */
	private $streamName;

	public function getStreamName() : StreamName
	{
		return $this->streamName;
	}

	public function withStreamName( StreamName $streamName ) : self
	{
		$this->streamName = $streamName;

		return $this;
	}
}
