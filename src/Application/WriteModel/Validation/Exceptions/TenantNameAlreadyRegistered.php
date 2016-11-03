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

namespace hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions;

use hollodotme\IdentityAndAccess\Application\Exceptions\ApplicationException;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantId;
use hollodotme\IdentityAndAccess\Application\WriteModel\Tenants\TenantName;

/**
 * Class TenantNameAlreadyRegistered
 * @package hollodotme\IdentityAndAccess\Application\WriteModel\Validation\Exceptions
 */
final class TenantNameAlreadyRegistered extends ApplicationException
{
	/** @var TenantName */
	private $tenantName;

	/** @var TenantId */
	private $tenantId;

	public function getTenantName(): TenantName
	{
		return $this->tenantName;
	}

	public function getTenantId(): TenantId
	{
		return $this->tenantId;
	}

	public function withTenantNameAndId( TenantName $tenantName, TenantId $tenantId ): TenantNameAlreadyRegistered
	{
		$this->tenantName = $tenantName;
		$this->tenantId   = $tenantId;

		return $this;
	}
}
