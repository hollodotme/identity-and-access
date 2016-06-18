<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

/**
 * Interface StoresEventStream
 * @package hollodotme\EventStore\Interfaces
 */
interface StoresEventStream extends PersistsEventStream, RetrievesEventStream
{

}