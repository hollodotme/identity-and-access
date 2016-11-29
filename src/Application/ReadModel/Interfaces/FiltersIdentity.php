<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;

/**
 * Interface FiltersIdentity
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces
 */
interface FiltersIdentity
{
	public function isValid( Identity $identity ): bool;
}
