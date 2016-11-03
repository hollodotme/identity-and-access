<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Bridges;

use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;

/**
 * Class AbstractPostRequestHandler
 * @package hollodotme\IdentityAndAccess\Bridges
 */
abstract class AbstractPostRequestHandler implements HandlesPostRequest
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function handle( ProvidesWriteRequestData $request )
	{
		$this->handleRequest( $request, $this->env );
	}

	abstract public function handleRequest( ProvidesWriteRequestData $request, Env $env );
}
