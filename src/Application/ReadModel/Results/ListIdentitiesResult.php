<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Results;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;

/**
 * Class ListIdentitiesResult
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Results
 */
final class ListIdentitiesResult extends AbstractResult
{
	/** @var array|Identity[] */
	private $identities = [];

	public function setIdentities( array $identities )
	{
		$this->identities = $identities;
	}

	public function getIdentities()
	{
		return $this->identities;
	}
}
