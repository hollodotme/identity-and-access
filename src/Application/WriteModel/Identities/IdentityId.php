<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

use hollodotme\IdentityAndAccess\Application\Traits\UUIDGenerating;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityId
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class IdentityId implements RepresentsValueAsString
{
	use Scalarizing;
	use UUIDGenerating;

	/** @var string */
	private $identityId;

	public function __construct( string $identityId )
	{
		$this->identityId = $identityId;
	}

	public function toString() : string
	{
		return $this->identityId;
	}
}
