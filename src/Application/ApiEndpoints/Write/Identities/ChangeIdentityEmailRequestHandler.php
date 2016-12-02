<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\IdentityEmailValidator;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\IdentityIdValidator;
use hollodotme\IdentityAndAccess\Application\CompositeUserInputValidator;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Application\Responses\OK;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\ChangeIdentityEmailCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions\IdentityEmailAlreadyRegistered;
use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class ChangeIdentityEmailRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities
 */
final class ChangeIdentityEmailRequestHandler extends AbstractWriteRequestHandler implements HandlesPostRequest
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		$input     = $request->getInput();
		$userInput = new UserInput( $input->getData() );
		$validator = new CompositeUserInputValidator();
		$validator->addValidator( new IdentityIdValidator( $userInput ) );
		$validator->addValidator( new IdentityEmailValidator( $userInput ) );

		if ( $validator->failed() )
		{
			(new Json())->respond( $validator->getMessages(), HttpCode::BAD_REQUEST );

			return;
		}

		$identityId    = new IdentityId( new UUID( (string)$input->get( 'identityId' ) ) );
		$identityEmail = new IdentityEmail( (string)$input->get( 'identityEmail' ) );
		$command       = new ChangeIdentityEmailCommand( $identityId, $identityEmail );

		try
		{
			$env->getCommandBus()->dispatch( $command, $env );

			(new OK())->respond();
		}
		catch ( IdentityEmailAlreadyRegistered $e )
		{
			$message = ['identityEmail' => ['Email address already registered: ' . $e->getIdentityEmail()]];
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
	}
}
