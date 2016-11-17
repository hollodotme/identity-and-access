<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\RegisterIdentityValidator;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Application\Responses\OK;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\RegisterIdentityCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityName;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityPasswordHash;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions\IdentityEmailAlreadyRegistered;
use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\StandardTypes\Password;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class RegisterIdentityRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities
 */
final class RegisterIdentityRequestHandler extends AbstractWriteRequestHandler implements HandlesPostRequest
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		$input     = $request->getInput();
		$userInput = new UserInput( $input->getData() );
		$validator = new RegisterIdentityValidator( $userInput );

		if ( $validator->failed() )
		{
			(new Json())->respond( $validator->getMessages(), HttpCode::BAD_REQUEST );

			return;
		}

		$password = new Password( $input->get( 'password' ) );
		$command  = new RegisterIdentityCommand(
			new IdentityEmail( $input->get( 'email' ) ),
			new IdentityPasswordHash( $password->getHash() ),
			new IdentityName( $input->get( 'name' ) )
		);

		try
		{
			$env->getCommandBus()->dispatch( $command, $env );

			(new OK())->respond();
		}
		catch ( IdentityEmailAlreadyRegistered $e )
		{
			$message = [
				'email' => [
					$e->getIdentityEmail() . ' is already registered with ID: ' . $e->getIdentityId(),
				],
			];

			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
	}
}
