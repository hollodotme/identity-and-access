<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\IceHawk;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\ListIdentitiesRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants\ListTenantsRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\RegisterIdentityRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\BlockTenantRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\RegisterTenantRequestHandler;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\UnblockTenantRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalReadResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalWriteResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Routing\Patterns\RegExp;
use IceHawk\IceHawk\Routing\ReadRoute;
use IceHawk\IceHawk\Routing\ReadRouteGroup;
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
			# REST API
			new ReadRouteGroup(
				new RegExp( '#^/api/v1/#' ),
				[
					new ReadRoute(
						new RegExp( '#/tenant/list/?#' ),
						new ListTenantsRequestHandler( $this->env )
					),
					new ReadRoute(
						new RegExp( '#/identity/list/?#' ),
						new ListIdentitiesRequestHandler( $this->env )
					),
				]
			),
		];
	}

	public function getWriteRoutes()
	{
		return [
			# REST API
			new WriteRouteGroup(
				new RegExp( '#^/api/v1/#' ),
				[
					new WriteRoute(
						new RegExp( '#/tenant/?$#' ),
						new RegisterTenantRequestHandler( $this->env )
					),
					new WriteRoute(
						new RegExp( '#/tenant/block/?$#' ),
						new BlockTenantRequestHandler( $this->env )
					),
					new WriteRoute(
						new RegExp( '#/tenant/unblock/?$#' ),
						new UnblockTenantRequestHandler( $this->env )
					),
					new WriteRoute(
						new RegExp( '#/identity/?$#' ),
						new RegisterIdentityRequestHandler( $this->env )
					),
				]
			),
		];
	}
}
