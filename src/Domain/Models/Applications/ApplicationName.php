<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Applications;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class ApplicationName
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Applications
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