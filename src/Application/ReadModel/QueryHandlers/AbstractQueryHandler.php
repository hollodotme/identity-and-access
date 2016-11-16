<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers;

use hollodotme\IdentityAndAccess\Env;

/**
 * Class AbstractQueryHandler
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers
 */
abstract class AbstractQueryHandler
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	final protected function getEnv() : Env
	{
		return $this->env;
	}
}
