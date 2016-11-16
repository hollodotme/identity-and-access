<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Tenants;

/**
 * Class Tenant
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Tenants
 */
final class Tenant implements \JsonSerializable
{
	/** @var string */
	private $id;

	/** @var string */
	private $name;

	/** @var string */
	private $state;

	public function __construct( string $id, string $name, string $state )
	{
		$this->id    = $id;
		$this->name  = $name;
		$this->state = $state;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getState(): string
	{
		return $this->state;
	}

	public function jsonSerialize()
	{
		return [
			'tenantId'    => $this->id,
			'tenantName'  => $this->name,
			'tenantState' => $this->state,
		];
	}
}
