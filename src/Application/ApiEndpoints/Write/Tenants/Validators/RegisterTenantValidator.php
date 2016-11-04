<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace hollodotme\IdentityAndAccess\Application\Endpoints\Write\Tenants\Validators;

use hollodotme\FluidValidator\FluidValidator;
use hollodotme\IdentityAndAccess\Application\AbstractUserInputValidator;

/**
 * Class RegisterTenantValidator
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Write\Tenants\Validators
 */
final class RegisterTenantValidator extends AbstractUserInputValidator
{
	protected function validate( FluidValidator $validator )
	{
		$validator->isNonEmptyString(
			'tenantName',
			['tenantName' => 'Tenant name must be a valid, non-empty string.']
		);
	}
}
