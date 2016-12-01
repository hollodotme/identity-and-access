<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants\Filters\StateFilter;
use hollodotme\IdentityAndAccess\Application\ReadModel\Queries\ListTenantsQuery;
use hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers\ListTenantsQueryHandler;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Bridges\AbstractReadRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestInputData;

/**
 * Class ListTenantsRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Tenants
 */
final class ListTenantsRequestHandler extends AbstractReadRequestHandler implements HandlesGetRequest
{
	public function handleRequest( ProvidesReadRequestData $request, Env $env )
	{
		$input = $request->getInput();
		$query = new ListTenantsQuery();

		$this->addFiltersFromInput( $input, $query );

		$handler = new ListTenantsQueryHandler( $env );

		$result = $handler->handle( $query );

		if ( $result->succeeded() )
		{
			(new Json())->respond( $result->getTenants() );

			return;
		}

		(new Json())->respond( [ 'error' => [ $result->getMessage() ] ], HttpCode::INTERNAL_SERVER_ERROR );
	}

	private function addFiltersFromInput( ProvidesReadRequestInputData $input, ListTenantsQuery $query )
	{
		if ( !empty( $input->get( 'states' ) ) )
		{
			$query->addFilter( new StateFilter( (array)$input->get( 'states' ) ) );
		}
	}
}
