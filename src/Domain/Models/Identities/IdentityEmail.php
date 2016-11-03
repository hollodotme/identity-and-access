<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Identities;

use hollodotme\IdentityAndAccess\Domain\Models\Identities\Exceptions\InvalidEmailAddress;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityEmail
 * @package hollodotme\IdentityAndAccess\Domain\Models\Identities
 */
final class IdentityEmail implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $emailAddress;

	public function __construct( string $emailAddress )
	{
		$this->emailAddress = $emailAddress;
	}

	public function toString() : string
	{
		return $this->emailAddress;
	}
}
