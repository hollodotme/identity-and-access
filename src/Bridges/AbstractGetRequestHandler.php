<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Bridges;

use hollodotme\IdentityAndAccess\Env;
use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;

/**
 * Class AbstractGetRequestHandler
 * @package hollodotme\IdentityAndAccess\Bridges
 */
abstract class AbstractGetRequestHandler implements HandlesGetRequest
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function handle( ProvidesReadRequestData $request )
	{
		$this->handleRequest( $request, $this->env );
	}

	abstract public function handleRequest( ProvidesReadRequestData $request, Env $env );
}
