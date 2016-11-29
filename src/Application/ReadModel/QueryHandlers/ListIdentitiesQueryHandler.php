<?php declare(strict_types = 1);
/**
 * @author: hollodotme
 */

namespace hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers;

use hollodotme\IdentityAndAccess\Application\ReadModel\Identities\Identity;
use hollodotme\IdentityAndAccess\Application\ReadModel\Queries\ListIdentitiesQuery;
use hollodotme\IdentityAndAccess\Application\ReadModel\Results\ListIdentitiesResult;

/**
 * Class ListIdentitiesQueryHandler
 * @package hollodotme\IdentityAndAccess\Application\ReadModel\QueryHandlers
 */
final class ListIdentitiesQueryHandler extends AbstractQueryHandler
{
	public function handle( ListIdentitiesQuery $query ): ListIdentitiesResult
	{
		$redisManager = $this->getEnv()->getRedisManager();
		$identities   = $redisManager->hGetAll( 'identities' );

		$identityList = [];
		foreach ( $identities as $identityId => $identityData )
		{
			$identityInfo   = json_decode( $identityData, true );
			$identityList[] = new Identity(
				$identityId,
				$identityInfo['email'],
				$identityInfo['name']
			);
		}

		foreach ( $query->getFilters() as $filter )
		{
			$identityList = array_filter( $identityList, [ $filter, 'isValid' ] );
		}

		$result = new ListIdentitiesResult();
		$result->setIdentities( $identityList );

		return $result;
	}
}
