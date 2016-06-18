<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace hollodotme\IdentityAndAccess;

use hollodotme\EventStore\Adapters\MySql\MySqlAdapter;
use hollodotme\EventStore\Adapters\MySql\MySqlConnection;
use hollodotme\EventStore\EventStore;

error_reporting( -1 );
ini_set( 'display_errors', 'On' );

require(__DIR__ . '/../vendor/autoload.php');

$connection   = new MySqlConnection( 'localhost', 3306, 'IdentityAndAccess', 'root', 'root' );
$mySqlAdapter = new MySqlAdapter( $connection );

$eventStore = new EventStore( $mySqlAdapter );