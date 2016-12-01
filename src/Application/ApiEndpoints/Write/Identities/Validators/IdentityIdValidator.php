<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators;

use hollodotme\FluidValidator\FluidValidator;
use hollodotme\IdentityAndAccess\Application\AbstractUserInputValidator;

/**
 * Class IdentityIdValidator
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Identities\Validators
 */
final class IdentityIdValidator extends AbstractUserInputValidator
{
	protected function validate( FluidValidator $validator )
	{
		$validator->isUuid( 'identityId', [ 'identityId' => 'Identity ID must be a valid UUID string.' ] );
	}
}
