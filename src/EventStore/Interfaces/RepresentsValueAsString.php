<?php
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Interfaces;

/**
 * Interface IdentifiesThings
 * @package hollodotme\EventStore\Interfaces
 */
interface RepresentsValueAsString extends \JsonSerializable
{
	public function toString() : string;

	public function __toString() : string;
}