<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Interfaces;

/**
 * Interface IdentifiesThings
 * @package hollodotme\PubSub\Interfaces
 */
interface RepresentsValueAsString extends \JsonSerializable
{
	public function toString() : string;

	public function __toString() : string;
}