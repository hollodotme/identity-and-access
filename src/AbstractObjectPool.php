<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess;

/**
 * Class AbstractObjectPool
 * @package hollodotme\IdentityAndAccess
 */
abstract class AbstractObjectPool
{
	/** @var array */
	private $pool;

	public function __construct()
	{
		$this->pool = [];
	}

	final protected function getSharedObject( string $key, \Closure $creator )
	{
		if ( !isset($this->pool[ $key ]) )
		{
			$this->pool[ $key ] = $creator->call( $this );
		}

		return $this->pool[ $key ];
	}
}
