<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Commands;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityName;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityPasswordHash;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Interfaces\CarriesInstruction;

/**
 * Class RegisterIdentityCommand
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Commands
 */
final class RegisterIdentityCommand implements CarriesInstruction
{
	/** @var IdentityEmail */
	private $email;

	/** @var IdentityPasswordHash */
	private $passwordHash;

	/** @var IdentityName */
	private $name;

	public function __construct( IdentityEmail $email, IdentityPasswordHash $passwordHash, IdentityName $name )
	{
		$this->email        = $email;
		$this->passwordHash = $passwordHash;
		$this->name         = $name;
	}

	public function getEmail(): IdentityEmail
	{
		return $this->email;
	}

	public function getPasswordHash(): IdentityPasswordHash
	{
		return $this->passwordHash;
	}

	public function getName(): IdentityName
	{
		return $this->name;
	}
}
