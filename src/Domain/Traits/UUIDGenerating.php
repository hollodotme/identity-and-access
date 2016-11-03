<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Traits;

use hollodotme\IdentityAndAccess\Domain\Services\UUIDGenerator;

/**
 * Trait UUIDGenerating
 * @package hollodotme\IdentityAndAccess\Domain\Traits
 */
trait UUIDGenerating
{
	/**
	 * @return static
	 */
	public static function generate()
	{
		return new static( ( new UUIDGenerator() )->generateNewUUID() );
	}
}
