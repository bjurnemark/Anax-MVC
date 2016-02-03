<?php

/**
 * Settings for the database.
 *
 */

// Set defines depending on server
$server = php_uname('n');

if (preg_match("/VPCSE1V9E/", $server)) {
    /* Settings for local server */
    define('DB_HOST', 'localhost');
    define('MY_SQL',  '/opt/lampp/bin/mysql');
} else {
    /* Settings for student server */
    define('DB_HOST', 'blu-ray.student.bth.se');
    define('MY_SQL',  '/usr/bin/mysql');
}


define('DB_USER', 'ulbj15');                    // The database username
define('DB_PASSWORD', '1,2Wq4D"');              // The database password

return [
    // Set up details on how to connect to the database
    'dsn'             => 'mysql:host=' . DB_HOST . ';dbname=ulbj15;',
    'username'        => DB_USER,
    'password'        => DB_PASSWORD,
    'driver_options'  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
    // 'table_prefix'      => "test_",


    // Display details on what happens
    'verbose' => false,

    // Throw a more verbose exception when failing to connect
    //'debug_connect' => 'true',
];
