<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\Validators;

use hollodotme\FluidValidator\FluidValidator;
use hollodotme\IdentityAndAccess\Application\AbstractUserInputValidator;

/**
 * Class TenantIdValidator
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\Validators
 */
final class TenantIdValidator extends AbstractUserInputValidator
{
	protected function validate( FluidValidator $validator )
	{
		$validator->isUuid( 'tenantId', [ 'tenantId' => 'Tenant ID must be a valid UUID string.' ] );
	}
}
