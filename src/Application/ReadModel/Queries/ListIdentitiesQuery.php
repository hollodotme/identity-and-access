<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Queries;

use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersIdentities;

/**
 * Class ListIdentitiesQuery
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Queries
 */
final class ListIdentitiesQuery
{
	/** @var array|FiltersIdentities[] */
	private $filters;

	public function __construct()
	{
		$this->filters = [];
	}

	public function addFilter( FiltersIdentities $filter )
	{
		$this->filters[] = $filter;
	}

	public function getFilters(): array
	{
		return $this->filters;
	}
}
