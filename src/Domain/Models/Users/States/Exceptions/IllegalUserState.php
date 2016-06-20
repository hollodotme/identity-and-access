<?php
/**
 * @author h.woltersdorf
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users\States\Exceptions;

use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class IllegalUserState
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users\States\Exceptions
 */
final class IllegalUserState extends IdentityAndAccessException
{
	/** @var string */
	private $stateName;

	public function getStateName() : string
	{
		return $this->stateName;
	}

	public function withStateName( string $stateName ) : self
	{
		$this->stateName = $stateName;

		return $this;
	}
}