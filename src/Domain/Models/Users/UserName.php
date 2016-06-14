<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UserName
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users
 */
final class UserName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $userName;

	public function __construct( string $userName )
	{
		$this->userName = $userName;
	}

	public function toString() : string
	{
		return $this->userName;
	}
}