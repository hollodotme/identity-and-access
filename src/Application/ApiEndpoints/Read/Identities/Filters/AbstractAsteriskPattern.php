<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters;

/**
 * Class AbstractAsteriskPattern
 * @package hollodotme\IdentityAndAccess\Application\ApiEndpoints\Read\Identities\Filters
 */
abstract class AbstractAsteriskPattern
{
	/** @var string */
	private $searchTerm;

	public function __construct( string $searchTerm )
	{
		$this->searchTerm = $searchTerm;
	}

	final protected function getRegExp(): string
	{
		$cleanString = preg_replace( "#[^a-z0-9@_\-\.\*]#", '', strtolower( $this->searchTerm ) );
		$cleanString = addcslashes( $cleanString, '-.' );
		$cleanString = str_replace( '*', '.*', $cleanString );

		return "#^{$cleanString}$#i";
	}
}
