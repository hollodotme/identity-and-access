<?php declare(strict_types = 1);
/**
 * @author h.woltersdorf
 */

namespace hollodotme\EventStore\Interfaces;

/**
 * Interface BuildsEventEnvelope
 * @package hollodotme\EventStore\Interfaces
 */
interface BuildsEventEnvelope
{
	public function fromRecord( array $record ) : EnclosesEvent;
}
