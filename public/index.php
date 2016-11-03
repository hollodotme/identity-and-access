<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess;

use hollodotme\IdentityAndAccess\Application\IceHawk\IceHawkConfig;
use hollodotme\IdentityAndAccess\Application\IceHawk\IceHawkDelegate;
use IceHawk\IceHawk\IceHawk;

require(__DIR__ . '/../vendor/autoload.php');

$env     = new Env();
$iceHawk = new IceHawk( new IceHawkConfig( $env ), new IceHawkDelegate( $env ) );

$iceHawk->init();
$iceHawk->handleRequest();
