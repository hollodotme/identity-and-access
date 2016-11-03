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

namespace hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Exceptions;

use hollodotme\IdentityAndAccess\Infrastructure\Exceptions\InfrastructureException;

/**
 * Class InvalidCommandHandler
 * @package hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Exceptions
 */
final class InvalidCommandHandler extends InfrastructureException
{
	/** @var string */
	private $commandHandlerClass;

	public function getCommandHandlerClass(): string
	{
		return $this->commandHandlerClass;
	}

	public function withCommandHandlerClass( string $commandHandlerClass ): InvalidCommandHandler
	{
		$this->commandHandlerClass = $commandHandlerClass;

		return $this;
	}
}
