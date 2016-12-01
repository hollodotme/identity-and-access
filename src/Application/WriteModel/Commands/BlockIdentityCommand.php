<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Commands;

use hollodotme\IdentityAndAccess\Application\WriteModel\Identities\IdentityId;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Interfaces\CarriesInstruction;

/**
 * Class BlockIdentityCommand
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Commands
 */
final class BlockIdentityCommand implements CarriesInstruction
{
	/** @var IdentityId */
	private $identityId;

	public function __construct( IdentityId $identityId )
	{
		$this->identityId = $identityId;
	}

	public function getIdentityId(): IdentityId
	{
		return $this->identityId;
	}
}
