<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersIdentities;

/**
 * Class StateFilter
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters
 */
final class StateFilter implements FiltersIdentities
{
	/** @var array */
	private $states;

	public function __construct( array $states )
	{
		$this->states = $states;
	}

	public function isValid( Identity $identity ): bool
	{
		return in_array( $identity->getState(), $this->states );
	}
}
