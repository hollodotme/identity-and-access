<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\Queries;

use hollodotme\IdentityAndAccess\Application\ReadModel\Interfaces\FiltersTenants;

/**
 * Class ListTenantsQuery
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\Queries
 */
final class ListTenantsQuery
{
	/** @var array|FiltersTenants[] */
	private $filters;

	public function __construct()
	{
		$this->filters = [];
	}

	public function addFilter( FiltersTenants $filter )
	{
		$this->filters[] = $filter;
	}

	public function getFilters()
	{
		return $this->filters;
	}
}
