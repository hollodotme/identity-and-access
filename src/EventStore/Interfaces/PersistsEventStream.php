<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\Types\EventStream;

/**
 * Interface PersistsEventStream
 * @package hollodotme\EventStore\Interfaces
 */
interface PersistsEventStream
{
	public function persistEventStream( EventStream $eventStream );
}
