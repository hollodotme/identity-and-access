<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class ApplicationName
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications
 */
final class ApplicationName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $applicationName;

	public function __construct( string $applicationName )
	{
		$this->applicationName = $applicationName;
	}

	public function toString() : string
	{
		return $this->applicationName;
	}
}