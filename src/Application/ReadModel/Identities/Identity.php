<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Identities;

/**
 * Class Identity
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Identities
 */
final class Identity implements \JsonSerializable
{
	/** @var string */
	private $id;

	/** @var string */
	private $email;

	/** @var string */
	private $name;

	/** @var string */
	private $state;

	public function __construct( string $id, string $email, string $name, string $state )
	{
		$this->id    = $id;
		$this->email = $email;
		$this->name  = $name;
		$this->state = $state;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getEmail(): string
	{
		return $this->email;
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
			'identityId'    => $this->id,
			'identityName'  => $this->name,
			'identityEmail' => $this->email,
			'identityState' => $this->state,
		];
	}
}
