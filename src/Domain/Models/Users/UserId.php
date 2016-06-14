<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Users;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\StandardTypes\UUID;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UserId
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Users
 */
final class UserId implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var UUID */
	private $userId;

	public function __construct( UUID $userId )
	{
		$this->userId = $userId;
	}

	public function toString() : string
	{
		return $this->userId->toString();
	}
}