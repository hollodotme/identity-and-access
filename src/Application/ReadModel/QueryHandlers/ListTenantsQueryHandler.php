<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers;

use hollodotme\IdentityAndAccess\Application\ReadModel\Queries\ListTenantsQuery;
use hollodotme\IdentityAndAccess\Application\ReadModel\Results\ListTenantsResult;
use hollodotme\IdentityAndAccess\Application\ReadModel\Tenants\Tenant;

/**
 * Class ListTenantsQueryHandler
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers
 */
final class ListTenantsQueryHandler extends AbstractQueryHandler
{
	public function handle( ListTenantsQuery $query ) : ListTenantsResult
	{
		$redisManager = $this->getEnv()->getRedisManager();
		$tenants      = $redisManager->hGetAll( 'tenants' );

		$tenantList = [];
		foreach ( $tenants as $tenantId => $tenantData )
		{
			$tenantInfo   = json_decode( $tenantData, true );
			$tenantList[] = new Tenant( $tenantId, $tenantInfo['name'], $tenantInfo['state'] );
		}

		if ( !empty($query->getTenantStates()) )
		{
			$tenantList = array_filter(
				$tenantList,
				function ( Tenant $tenant ) use ( $query )
				{
					return in_array( $tenant->getState(), $query->getTenantStates() );
				}
			);
		}

		$result = new ListTenantsResult();
		$result->setTenants( $tenantList );

		return $result;
	}
}
