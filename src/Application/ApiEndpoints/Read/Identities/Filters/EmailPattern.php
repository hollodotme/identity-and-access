<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersIdentity;

/**
 * Class EmailPattern
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters
 */
final class EmailPattern extends AbstractAsteriskPattern implements FiltersIdentity
{
	public function isValid( Identity $identity ): bool
	{
		return (bool)preg_match( $this->getRegExp(), $identity->getEmail() );
	}
}
