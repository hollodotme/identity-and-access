<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\Traits;

use hollodotme\IdentityAndAccess\Application\Services\UUIDGenerator;

/**
 * Trait UUIDGenerating
 * @package hollodotme\IdentityAndAccess\Application\Traits
 */
trait UUIDGenerating
{
	/**
	 * @return static
	 */
	public static function generate()
	{
		return new static( (new UUIDGenerator())->generateNewUUID() );
	}
}
