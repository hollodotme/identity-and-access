<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters\EmailPattern;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters\NamePattern;
use hollodotme\IdentityAndAccess\Application\ReadModel\Queries\ListIdentitiesQuery;
use hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers\ListIdentitiesQueryHandler;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Bridges\AbstractReadRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use IceHawk\IceHawk\Interfaces\ProvidesRequestInputData;

/**
 * Class ListIdentitiesRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities
 */
final class ListIdentitiesRequestHandler extends AbstractReadRequestHandler implements HandlesGetRequest
{
	public function handleRequest( ProvidesReadRequestData $request, Env $env )
	{
		$input = $request->getInput();
		$query = new ListIdentitiesQuery();

		$this->addFiltersFromInput( $input, $query );

		$handler = new ListIdentitiesQueryHandler( $env );

		$result = $handler->handle( $query );

		if ( $result->succeeded() )
		{
			(new Json())->respond( $result->getIdentities() );

			return;
		}

		(new Json())->respond( [ 'error' => [ $result->getMessage() ] ], HttpCode::INTERNAL_SERVER_ERROR );
	}

	private function addFiltersFromInput( ProvidesRequestInputData $input, ListIdentitiesQuery $query )
	{
		if ( !empty( $input->get( 'name' ) ) )
		{
			$query->addFilter( new NamePattern( $input->get( 'name' ) ) );
		}

		if ( !empty( $input->get( 'email' ) ) )
		{
			$query->addFilter( new EmailPattern( $input->get( 'email' ) ) );
		}
	}
}
