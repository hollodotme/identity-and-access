<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

use hollodotme\EventStore\EventStream;

/**
 * Interface PersistsEventStream
 * @package hollodotme\EventStore\Interfaces
 */
interface PersistsEventStream
{
	public function persistEventStream( EventStream $eventStream );
}