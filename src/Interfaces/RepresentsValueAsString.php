<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess\Interfaces;

/**
 * Interface IdentifiesThings
 * @package hollodotme\IdentityAndAccess\Interfaces
 */
interface RepresentsValueAsString extends \JsonSerializable
{
	public function toString() : string;

	public function __toString() : string;
}
