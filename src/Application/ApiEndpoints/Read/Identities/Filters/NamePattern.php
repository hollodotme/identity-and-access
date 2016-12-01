<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersIdentities;

/**
 * Class NamePattern
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters
 */
final class NamePattern extends AbstractAsteriskPattern implements FiltersIdentities
{
	public function isValid( Identity $identity ): bool
	{
		return (bool)preg_match( $this->getRegExp(), $identity->getName() );
	}
}
