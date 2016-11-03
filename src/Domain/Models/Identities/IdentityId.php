<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Identities;

use hollodotme\IdentityAndAccess\Domain\Traits\UUIDGenerating;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class IdentityId
 * @package hollodotme\IdentityAndAccess\Domain\Models\Identities
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
