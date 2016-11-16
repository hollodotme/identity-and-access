<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Results;

use hollodotme\IdentityAndAccess\Application\ReadModel\Constants\ResultType;

/**
 * Class AbstractResult
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Results
 */
abstract class AbstractResult
{
	/** @var int */
	private $type;

	/** @var string */
	private $message;

	public function __construct( int $type = ResultType::SUCCESS, $message = '' )
	{
		$this->type    = $type;
		$this->message = $message;
	}

	public function succeeded() : bool
	{
		return ($this->type === ResultType::SUCCESS);
	}

	public function failed() : bool
	{
		return ($this->type === ResultType::FAILURE);
	}

	public function getMessage(): string
	{
		return $this->message;
	}
}
