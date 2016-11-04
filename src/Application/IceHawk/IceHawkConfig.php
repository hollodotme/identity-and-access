<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\IceHawk;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\RegisterIdentityRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\RegisterTenantRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalReadResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalWriteResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Routing\Patterns\RegExp;
use IceHawk\IceHawk\Routing\WriteRoute;
use IceHawk\IceHawk\Routing\WriteRouteGroup;

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
			# REST API
			new WriteRouteGroup(
				new RegExp( '#^/api/v1/#' ),
				[
					new WriteRoute( new RegExp( '#/tenant/?$#' ), new RegisterTenantRequestHandler( $this->env ) ),
					new WriteRoute( new RegExp( '#/identity/?$#' ), new RegisterIdentityRequestHandler( $this->env ) ),
				]
			),
		];
	}
}
