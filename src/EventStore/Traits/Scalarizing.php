<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\EventStore\Traits;

/**
 * Trait Scalarizing
 * @package hollodotme\EventStore\Traits
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
