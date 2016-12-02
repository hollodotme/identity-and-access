<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\IdentityEmailValidator;
use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\IdentityIdValidator;
use hollodotme\IdentityAndAccess\Application\CompositeUserInputValidator;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
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
	}
}
