<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Users;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class UserId
 * @package hollodotme\IdentityAndAccess\Domain\Models\Users
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