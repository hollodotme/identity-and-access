<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications;

use hollodotme\IdentityAndAccess\Domain\Traits\UUIDGenerating;
use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class ApplicationId
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications
 */
final class ApplicationId implements RepresentsValueAsString
{
	use Scalarizing;
	use UUIDGenerating;

	/** @var UUID */
	private $applicationId;

	public function __construct( UUID $applicationId )
	{
		$this->applicationId = $applicationId;
	}

	public function toString() : string
	{
		return $this->applicationId->toString();
	}
}