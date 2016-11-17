<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators;

use hollodotme\FluidValidator\FluidValidator;
use hollodotme\IdentityAndAccess\Application\AbstractUserInputValidator;

/**
 * Class RegisterIdentityValidator
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators
 */
final class RegisterIdentityValidator extends AbstractUserInputValidator
{
	protected function validate( FluidValidator $validator )
	{
		$validator->isEmail( 'email', [ 'email' => 'Invalid email address.' ] )
		          ->isNonEmptyString( 'password', [ 'password' => 'Password must be a non-empty string.' ] )
		          ->isNonEmptyString( 'name', [ 'name' => 'Name must be a non-empty string.' ] );
	}
}
