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

namespace hollodotme\IdentityAndAccess\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;

/**
 * Class Json
 * @package hollodotme\IdentityAndAccess\Application\Responses
 */
final class Json
{
	public function respond( $data, int $httpCode = HttpCode::OK )
	{
		header( 'Content-Type: application/json; charset=utf-8', true, $httpCode );
		echo json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		flush();
	}
}
