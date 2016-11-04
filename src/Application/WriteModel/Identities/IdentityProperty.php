<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Identities;

/**
 * Class IdentityProperty
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Identities
 */
final class IdentityProperty
{
	/** @var string */
	private $propertyName;

	/** @var string */
	private $propertyValue;

	public function __construct( string $propertyName, string $propertyValue )
	{
		$this->propertyName  = $propertyName;
		$this->propertyValue = $propertyValue;
	}

	public function getPropertyName(): string
	{
		return $this->propertyName;
	}

	public function getPropertyValue(): string
	{
		return $this->propertyValue;
	}
}
