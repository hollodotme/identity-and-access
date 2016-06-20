<?php
/**
 * @author hollodotme
 */

namespace hollodotme\PubSub\Traits;

/**
 * Trait Scalarizing
 * @package hollodotme\PubSub\Traits
 */
trait Scalarizing
{
	abstract public function toString() : string;

	public function __toString() : string
	{
		return $this->toString();
	}

	public function jsonSerialize()
	{
		return $this->toString();
	}
}