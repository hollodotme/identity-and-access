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

namespace hollodotme\IdentityAndAccess\Tests\Init;

use hollodotme\IdentityAndAccess\Env;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlConnection;
use hollodotme\IdentityAndAccess\Infrastructure\Adapters\MySql\MySqlManager;
use hollodotme\IdentityAndAccess\Infrastructure\Configs\EventStoreMySqlConfig;
use hollodotme\IdentityAndAccess\Tests\Init\Client\IdaApiClient;

require(__DIR__ . '/../../vendor/autoload.php');

# Cleanup

$env = new Env();
$env->getRedisManager()->flushDB();

$mysqlConfig     = new EventStoreMySqlConfig();
$mysqlConnection = new MySqlConnection(
	$mysqlConfig->getHost(),
	$mysqlConfig->getPort(),
	$mysqlConfig->getDatabase(),
	$mysqlConfig->getUsername(),
	$mysqlConfig->getPassword()
);
$mysqlManager    = new MySqlManager( $mysqlConnection );

$mysqlManager->query( 'TRUNCATE TABLE EventStore' );

# Action

$idaApiClient = new IdaApiClient();
$results      = [];

$tenantsToRegister = ['More & More', 'Carl Gross', 'Strauss Innovation'];

foreach ( $tenantsToRegister as $tenantName )
{
	$results[ 'Register ' . $tenantName ] = $idaApiClient->registerTenant( $tenantName );
}

$tenants = $idaApiClient->listTenants();

$tenantsToBlock = [1];

foreach ( $tenantsToBlock as $index )
{
	$tenant                                      = $tenants[ $index ];
	$results[ 'Block ' . $tenant['tenantName'] ] = $idaApiClient->blockTenant( $tenant['tenantId'] );
}

$results['Tenants'] = $idaApiClient->listTenants();

$identitiesToRegister = [
	['email' => 'hw@hollo.me', 'password' => 'test123', 'name' => 'Holger Woltersdorf'],
];

foreach ( $identitiesToRegister as $item )
{
	$results[ 'Register ' . $item['name'] ] = $idaApiClient->registerIdentity(
		$item['email'], $item['password'], $item['name']
	);
}

# Output

foreach ( $results as $key => $result )
{
	printf( "%-30s: %s\n", $key, print_r( $result, true ) );
}