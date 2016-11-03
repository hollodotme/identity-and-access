<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\IceHawk;

use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\SetsUpEnvironment;

/**
 * Class IceHawkDelegate
 * @package hollodotme\IdentityAndAccess\Application\IceHawk
 */
final class IceHawkDelegate implements SetsUpEnvironment
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function setUpGlobalVars()
	{
	}

	public function setUpErrorHandling( ProvidesRequestInfo $requestInfo )
	{
		error_reporting( -1 );
		ini_set( 'display_errors', 'On' );
	}

	public function setUpSessionHandling( ProvidesRequestInfo $requestInfo )
	{
	}
}
