<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators;

use hollodotme\FluidValidator\FluidValidator;
use hollodotme\IdentityAndAccess\Application\AbstractUserInputValidator;

/**
 * Class IdentityEmailValidator
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators
 */
final class IdentityEmailValidator extends AbstractUserInputValidator
{
	protected function validate( FluidValidator $validator )
	{
		$validator->isEmail( 'identityEmail', [ 'identityEmail' => 'Invalid email address.' ] );
	}
}
