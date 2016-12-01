<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators\IdentityIdValidator;
use hollodotme\IdentityAndAccess\Application\Exceptions\AggregateReconstitutedWithoutHistory;
use hollodotme\IdentityAndAccess\Application\Responses\Json;
use hollodotme\IdentityAndAccess\Application\Responses\OK;
use hollodotme\IdentityAndAccess\Application\WriteModel\Commands\UnblockIdentityCommand;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\States\Exceptions\IllegalTenantStateTransition;
use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Bridges\UserInput;
use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;
use IceHawk\IceHawk\Constants\HttpCode;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class UnblockIdentityRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities
 */
final class UnblockIdentityRequestHandler extends AbstractWriteRequestHandler implements HandlesPostRequest
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		$input          = $request->getInput();
		$userInput      = new UserInput( $input->getData() );
		$inputValidator = new IdentityIdValidator( $userInput );

		if ( $inputValidator->failed() )
		{
			(new Json())->respond( $inputValidator->getMessages(), HttpCode::BAD_REQUEST );

			return;
		}

		$identityId = new IdentityId( new UUID( $input->get( 'identityId' ) ) );
		$command    = new UnblockIdentityCommand( $identityId );

		try
		{
			$env->getCommandBus()->dispatch( $command, $env );

			(new OK())->respond();
		}
		catch ( AggregateReconstitutedWithoutHistory $e )
		{
			$message = [ 'identityId' => [ $identityId . ' not found.' ] ];
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
		catch ( IllegalTenantStateTransition $e )
		{
			$message = [ 'identityState' => [ 'Illegal identity state transition.' ] ];
			(new Json())->respond( $message, HttpCode::BAD_REQUEST );
		}
	}
}
