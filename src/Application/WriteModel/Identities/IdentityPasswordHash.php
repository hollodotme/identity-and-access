<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityPassword
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class IdentityPasswordHash implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $passwordHash;

	public function __construct( string $passwordHash )
	{
		$this->passwordHash = $passwordHash;
	}

	public function toString() : string
	{
		return $this->passwordHash;
	}
}
