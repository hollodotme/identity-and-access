<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess;

use hollodotme\IdentityAndAccess\Application\DomainManager;
use hollodotme\IdentityAndAccess\Domain\Models\Tenants\TenantId;
use hollodotme\IdentityAndAccess\StandardTypes\UUID;

error_reporting( -1 );
ini_set( 'display_errors', 'On' );

require(__DIR__ . '/../vendor/autoload.php');

$domainManager = new DomainManager();

$tenant = $domainManager->getTenantsRepository()->findTenantWithId(
	new TenantId( new UUID( '5b013f2a-4a86-48bb-b213-001eab4ea29b' ) )
);

echo '<pre>', htmlspecialchars( print_r( $tenant, 1 ) ), '</pre>';

$domainManager->getTenantsRepository()->saveChanges( $tenant );