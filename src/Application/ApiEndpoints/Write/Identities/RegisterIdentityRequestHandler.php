<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Bridges\AbstractWriteRequestHandler;
use hollodotme\IdentityAndAccess\Env;
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
		// TODO: Implement handleRequest() method.
	}
}
