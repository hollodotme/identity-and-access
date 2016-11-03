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

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\FluidValidator\CheckMode;
use hollodotme\FluidValidator\FluidValidator;
use hollodotme\FluidValidator\MessageCollectors\GroupedListMessageCollector;
use hollodotme\IdentityAndAccess\Bridges\UserInput;

/**
 * Class AbstractUserInputValidator
 * @package hollodotme\IdentityAndAccess\Application
 */
abstract class AbstractUserInputValidator
{
	/** @var FluidValidator */
	private $validator;

	public function __construct( UserInput $userInput )
	{
		$this->validator = new FluidValidator( CheckMode::CONTINUOUS, $userInput, new GroupedListMessageCollector() );
	}

	public function failed() : bool
	{
		$this->validate( $this->validator );

		return $this->validator->failed();
	}

	abstract protected function validate( FluidValidator $validator );

	public function passed() : bool
	{
		$this->validate( $this->validator );

		return $this->validator->passed();
	}

	public function getMessages() : array
	{
		return $this->validator->getMessages();
	}
}
