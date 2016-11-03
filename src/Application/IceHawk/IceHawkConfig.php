<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\IceHawk;

use hollodotme\IdentityAndAccess\Application\Endpoints\Write\Tenants\RegisterTenantRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalReadResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalWriteResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\WriteRoute;

/**
 * Class IceHawkConfig
 * @package hollodotme\IdentityAndAccess\Application\IceHawk
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use DefaultRequestInfoProviding;
	use DefaultEventSubscribing;
	use DefaultFinalReadResponding;
	use DefaultFinalWriteResponding;

	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function getReadRoutes()
	{
		return [

		];
	}

	public function getWriteRoutes()
	{
		return [
			new WriteRoute( new Literal( '/tenant' ), new RegisterTenantRequestHandler( $this->env ) ),
			new WriteRoute( new Literal( '/identity' ), new RegisterTenantRequestHandler( $this->env ) ),
		];
	}
}
