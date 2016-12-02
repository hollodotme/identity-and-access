<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application;

use hollodotme\IdentityAndAccess\Application\Interfaces\ValidatesUserInput;

/**
 * Class CompositeUserInputValidator
 * @package hollodotme\IdentityAndAccess\Application
 */
final class CompositeUserInputValidator implements ValidatesUserInput
{
	/** @var AbstractUserInputValidator[] */
	private $validators;

	/** @var bool */
	private $passed;

	/** @var array */
	private $messages;

	public function __construct()
	{
		$this->validators = [];
		$this->passed     = false;
		$this->messages   = [];
	}

	public function addValidator( ValidatesUserInput $validator )
	{
		$this->validators[] = $validator;
	}

	public function passed(): bool
	{
		$this->passed = false;

		$this->validate();

		return $this->passed;
	}

	private function validate()
	{
		$this->passed = true;

		foreach ( $this->validators as $validator )
		{
			if ( $validator->failed() )
			{
				$this->passed   = false;
				$this->messages = array_merge( $this->messages, $validator->getMessages() );
			}
		}
	}

	public function failed(): bool
	{
		return !$this->passed();
	}

	public function getMessages(): array
	{
		return $this->messages;
	}
}
