<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\Validators\TenantIdValidator;
use hollodotme\IdentityAndAccess\Application\Exceptions\AggregateReconstitutedWithoutHistory;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Application\Responses\OK;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\UnblockTenantCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions\IllegalTenantStateTransition;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class UnblockTenantRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants
 */
final class UnblockTenantRequestHandler extends AbstractWriteRequestHandler implements HandlesPostRequest
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		$input          = $request->getInput();
		$userInput      = new UserInput( $input->getData() );
		$inputValidator = new TenantIdValidator( $userInput );

		if ( $inputValidator->failed() )
		{
			(new Json())->respond( $inputValidator->getMessages(), HttpCode::BAD_REQUEST );

			return;
		}

		$tenantId = new TenantId( new UUID( $input->get( 'tenantId' ) ) );
		$command  = new UnblockTenantCommand( $tenantId );

		try
		{
			$env->getCommandBus()->dispatch( $command, $env );

			(new OK())->respond();
		}
		catch ( AggregateReconstitutedWithoutHistory $e )
		{
			$message = [ 'tenantId' => [ $tenantId . ' not found.' ] ];
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
		catch ( IllegalTenantStateTransition $e )
		{
			$message = [ 'state' => [ 'Illegal tenant state transition.' ] ];
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
	}
}
