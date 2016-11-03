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

namespace hollodotme\IdentityAndAccess\Infrastructure\Ports;

use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Exceptions\CommandHandlerNotFound;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Exceptions\InvalidCommandHandler;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Interfaces\CarriesInstruction;
use hollodotme\IdentityAndAccess\Infrastructure\Ports\CommandBus\Interfaces\HandlesCommand;

/**
 * Class CommandBus
 * @package hollodotme\IdentityAndAccess\Infrastructure\Ports
 */
final class CommandBus
{
	const COMMAND_HANDLE_METHOD = 'handle';

	/** @var array */
	private $commandHandlerMap;

	public function __construct()
	{
		$this->commandHandlerMap = [];
	}

	public function registerCommandHandler( string $commandClass, string $commandHandlerClass )
	{
		$this->commandHandlerMap[ $commandClass ] = $commandHandlerClass;
	}

	public function dispatch( CarriesInstruction $command, Env $env )
	{
		$commandHandler = $this->getCommandHandlerForCommand( $command, $env );

		$this->guardCommandHandlerIsValid( $commandHandler );

		call_user_func( [$commandHandler, self::COMMAND_HANDLE_METHOD], $command );
	}

	private function getCommandHandlerForCommand( CarriesInstruction $command, Env $env ) : HandlesCommand
	{
		$commandClass = get_class( $command );

		if ( isset($this->commandHandlerMap[ $commandClass ]) )
		{
			$commandHandlerClass = $this->commandHandlerMap[ $commandClass ];
			$commandHandler      = new $commandHandlerClass( $env );

			return $commandHandler;
		}

		throw (new CommandHandlerNotFound())->withCommandClass( $commandClass );
	}

	private function guardCommandHandlerIsValid( HandlesCommand $commandHandler )
	{
		if ( !is_callable( [$commandHandler, self::COMMAND_HANDLE_METHOD] ) )
		{
			throw (new InvalidCommandHandler())->withCommandHandlerClass( get_class( $commandHandler ) );
		}
	}
}
