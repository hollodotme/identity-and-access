<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Traits;

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