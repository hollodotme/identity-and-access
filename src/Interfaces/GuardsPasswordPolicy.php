<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Interfaces;

/**
 * Interface GuardsPasswordPolicy
 * @package hollodotme\IdentityAndAccess\Interfaces
 */
interface GuardsPasswordPolicy
{
	public function matchesPolicy( string $passphrase ) : bool;
}
