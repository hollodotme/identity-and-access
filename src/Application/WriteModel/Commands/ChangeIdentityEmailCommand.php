<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Commands;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityEmail;
use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;

/**
 * Class ChangeIdentityEmailCommand
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Commands
 */
final class ChangeIdentityEmailCommand
{
	/** @var IdentityId */
	private $identityId;

	/** @var IdentityEmail */
	private $identityEmail;

	public function __construct( IdentityId $identityId, IdentityEmail $identityEmail )
	{
		$this->identityId    = $identityId;
		$this->identityEmail = $identityEmail;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}

	public function getIdentityEmail(): IdentityEmail
	{
		return $this->identityEmail;
	}
}
