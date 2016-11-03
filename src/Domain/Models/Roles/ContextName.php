<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Domain\Models\Roles;

use hollodotme\IdentityAndAccess\Interfaces\RepresentsValueAsString;
use hollodotme\IdentityAndAccess\Traits\Scalarizing;

/**
 * Class ContextName
 * @package hollodotme\IdentityAndAccess\Domain\Models\Roles
 */
final class ContextName implements RepresentsValueAsString
{
	use Scalarizing;

	/** @var string */
	private $contextName;

	public function __construct( string $contextName )
	{
		$this->contextName = $contextName;
	}

	public function toString() : string
	{
		return $this->contextName;
	}
}
