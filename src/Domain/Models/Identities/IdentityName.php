<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Identities;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityName
 * @package hollodotme\IdentityAndAccess\Domain\Models\Identities
 */
final class IdentityName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $identityName;

	public function __construct( string $identityName )
	{
		$this->identityName = $identityName;
	}

	public function toString() : string
	{
		return $this->identityName;
	}
}
