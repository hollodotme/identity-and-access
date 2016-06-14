<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Domain\Models\Applications;

use Dreiwolt\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use Dreiwolt\IdentityAndAccess\StandardTypes\UUID;
use Dreiwolt\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class ApplicationId
 * @package Dreiwolt\IdentityAndAccess\Domain\Models\Applications
 */
final class ApplicationId implements RepresentsValueAsString
{
	use Scalarizing;

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