<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Exceptions;

use hollodotme\IdentityAndAccess\Exceptions\IdentityAndAccessException;

/**
 * Class IllegaldentityState
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities\States\Exceptions
 */
final class IllegaldentityState extends IdentityAndAccessException
{
	/** @var string */
	private $stateName;

	public function getStateName(): string
	{
		return $this->stateName;
	}

	public function withStateName( string $stateName ): IllegaldentityState
	{
		$this->stateName = $stateName;

		return $this;
	}
}
