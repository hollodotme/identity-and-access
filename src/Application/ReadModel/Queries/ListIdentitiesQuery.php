<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Queries;

use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersIdentity;

/**
 * Class ListIdentitiesQuery
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Queries
 */
final class ListIdentitiesQuery
{
	/** @var array|FiltersIdentity[] */
	private $filters;

	public function __construct()
	{
		$this->filters = [];
	}

	public function addFilter( FiltersIdentity $filter )
	{
		$this->filters[] = $filter;
	}

	public function getFilters(): array
	{
		return $this->filters;
	}
}
