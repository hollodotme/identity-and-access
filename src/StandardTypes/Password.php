<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\StandardTypes;

use hollodotme\IdentityAndAccess\Interfaces\GuardsPasswordPolicy;

/**
 * Class Password
 * @package hollodotme\IdentityAndAccess\StandardTypes
 */
final class Password
{
	/** @var string */
	private $passphrase;

	/** @var GuardsPasswordPolicy */
	private $policy;

	public function __construct( string $passphrase, GuardsPasswordPolicy $policy )
	{
		$this->passphrase = $passphrase;
	}

	public function getHash() : string
	{
		return password_hash( $this->passphrase, PASSWORD_DEFAULT );
	}

	public function needsRehash() : bool
	{
		return (bool)password_needs_rehash( $this->getHash(), PASSWORD_DEFAULT );
	}

	public function matches( string $hash ) : bool
	{
		return password_verify( $this->passphrase, $hash );
	}
}
