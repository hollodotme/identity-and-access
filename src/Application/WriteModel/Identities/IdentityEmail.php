<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityEmail
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
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
