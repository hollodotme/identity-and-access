<?php
/**
 * @author hollodotme
 */

namespace Dreiwolt\IdentityAndAccess\Interfaces;

/**
 * Interface IdentifiesThings
 * @package Dreiwolt\IdentityAndAccess\Interfaces
 */
interface RepresentsValueAsString extends \JsonSerializable
{
	public function toString() : string;

	public function __toString() : string;
}