<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants;

use hollodotme\IdentityAndAccess\Application\Endpoints\Write\Tenants\Validators\RegisterTenantValidator;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Application\Responses\OK;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterTenantCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantName;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions\TenantNameAlreadyRegistered;
use hollodotme\IdentityAndAccess\Bridges\AbstractPostRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class RegisterTenantRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants
 */
final class RegisterTenantRequestHandler extends AbstractPostRequestHandler
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		$input          = $request->getInput();
		$userInput      = new UserInput( $input->getData() );
		$inputValidator = new RegisterTenantValidator( $userInput );

		if ( $inputValidator->failed() )
		{
			(new Json())->respond( $inputValidator->getMessages(), HttpCode::BAD_REQUEST );

			return;
		}

		$tenantName = new TenantName( $input->get( 'tenantName' ) );
		$command    = new RegisterTenantCommand( $tenantName );

		try
		{
			$env->getCommandBus()->dispatch( $command, $env );

			(new OK())->respond();
		}
		catch ( TenantNameAlreadyRegistered $e )
		{
			$message = [
				'tenantName' => [
					$e->getTenantName() . ' is already registered with ID: ' . $e->getTenantId(),
				],
			];
			
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
	}
}
