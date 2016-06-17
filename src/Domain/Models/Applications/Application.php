<?php
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Applications;

/**
 * Class Application
 * @package hollodotme\IdentityAndAccess\Domain\Models\Applications
 */
final class Application
{
	/** @var ApplicationId */
	private $applicationId;

	/** @var ApplicationName */
	private $name;

	public function __construct( ApplicationId $applicationId, ApplicationName $name )
	{
		$this->applicationId = $applicationId;
		$this->name          = $name;
	}

	public function getApplicationId() : ApplicationId
	{
		return $this->applicationId;
	}

	public function getName() : ApplicationName
	{
		return $this->name;
	}
}