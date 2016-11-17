<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions;

use hollodotme\IdentityAndAccess\Application\Exceptions\ApplicationException;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;

/**
 * Class IdentityEmailAlreadyRegistered
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions
 */
final class IdentityEmailAlreadyRegistered extends ApplicationException
{
	/** @var IdentityEmail */
	private $identityEmail;

	/** @var IdentityId */
	private $identityId;

	public function getIdentityEmail(): IdentityEmail
	{
		return $this->identityEmail;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function withIdentityEmailAndId(
		IdentityEmail $identityEmail, IdentityId $identityId
	): IdentityEmailAlreadyRegistered
	{
		$this->identityEmail = $identityEmail;
		$this->identityId    = $identityId;

		return $this;
	}
}
