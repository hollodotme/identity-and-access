<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Endpoints\Write\Identities;

use hollodotme\IdentityAndAccess\Bridges\AbstractPostRequestHandler;
use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class RegisterIdentityRequestHandler
 * @package hollodotme\IdentityAndAccess\Application\Endpoints\Write\Identities
 */
final class RegisterIdentityRequestHandler extends AbstractPostRequestHandler
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		// TODO: Implement handleRequest() method.
	}
}
